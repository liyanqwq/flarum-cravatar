<?php

/*
 * This file is part of ianm/gravatar.
 *
 * Copyright (c) 2021 IanM.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace IanM\Gravatar\Api\Controllers;

use Flarum\Http\Exception\RouteNotFoundException;
use Flarum\Settings\SettingsRepositoryInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;
use IanM\Gravatar\Exceptions\GravatarNotFoundException;
use IanM\Gravatar\Gravatar;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class GetGravatarImageController implements RequestHandlerInterface
{
    private Gravatar $gravatar;

    private SettingsRepositoryInterface $settings;

    public function __construct(Gravatar $gravatar, SettingsRepositoryInterface $settings)
    {
        $this->gravatar = $gravatar;
        $this->settings = $settings;
    }

    /**
     * Handle the request and return a response.
     *
     * @param ServerRequestInterface $request
     *
     * @throws \Flarum\User\Exception\PermissionDeniedException
     *
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        if (!(bool) $this->settings->get('ianm-gravatar.proxy', false)) {
            throw new RouteNotFoundException();
        }

        $id = Arr::get($request->getQueryParams(), 'id');

        $gravatarurl = $this->gravatar->getRemote($id);

        $client = new Client();

        try {
            $res = $client->request('GET', $gravatarurl, [
                'headers' => [
                    'Accept' => 'image/*',
                ],
            ]);
        } catch (GuzzleException $e) {
            if ($e->getCode() > 0 && $e->getCode() < 500) {
                throw new GravatarNotFoundException();
            }

            throw $e;
        }

        $type = $res->getHeaderLine('Content-Type');
        $contents = $res->getBody();

        if (!Str::startsWith($type, 'image/') || !$contents->getSize()) {
            throw new GravatarNotFoundException();
        }

        return new Response(
            $res->getStatusCode(),
            [
                'Content-Type' => $res->getHeaderLine('Content-Type'),
            ],
            $contents
        );
    }
}
