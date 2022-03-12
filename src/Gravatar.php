<?php

/*
 * This file is part of ianm/gravatar.
 *
 * Copyright (c) 2021 IanM.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace IanM\Gravatar;

use Flarum\Http\UrlGenerator;
use Flarum\Settings\SettingsRepositoryInterface;
use Flarum\User\User;

class Gravatar
{
    /**
     * Gravatar base url.
     *
     * @var string
     */
    private string $publicBaseUrl = 'https://cravatar.cn/avatar/';

    /**
     * Email address to check.
     *
     * @var string
     */
    private string $email;

    private SettingsRepositoryInterface $settings;

    private UrlGenerator $url;

    public function __construct(SettingsRepositoryInterface $settings, UrlGenerator $url)
    {
        $this->settings = $settings;
        $this->url = $url;
    }

    /**
     * Get the gravatar for the given user id.
     *
     * @param int $id
     *
     * @return string
     */
    public function getForUser(int $id): string
    {
        $user = User::findOrFail($id);

        if ((bool) $this->settings->get('ianm-gravatar.proxy', false)) {
            return $this->url->to('api')->route('ianm.gravatar.image', ['id' => $user->id]);
        }

        $this->email = $user->email;

        return $this->buildUrl();
    }

    /**
     * Get the gravatar directly from gravatar.com.
     *
     * @param int $id
     *
     * @return string
     */
    public function getRemote(int $id): string
    {
        $user = User::findOrFail($id);

        $this->email = $user->email;

        return $this->buildUrl();
    }

    /**
     * Helper function to md5 hash the email address.
     *
     * @return string
     */
    private function hashEmail(): string
    {
        return md5(strtolower(trim($this->email)));
    }

    /**
     * @return string
     */
    private function getExtension(): string
    {
        return '.png';
    }

    /**
     * @return string
     */
    private function buildUrl(): string
    {
        $url = $this->publicBaseUrl;
        $url .= $this->hashEmail();
        $url .= $this->getExtension();
        $url .= $this->getUrlParameters();

        return $url;
    }

    /**
     * @return string
     */
    private function getUrlParameters(): string
    {
        $build = [];

        foreach (get_class_methods($this) as $method) {
            if (substr($method, -strlen('Parameter')) !== 'Parameter') {
                continue;
            }

            if ($called = call_user_func([$this, $method])) {
                $build = array_replace($build, $called);
            }
        }

        return '?'.http_build_query($build);
    }

    /**
     * @return array|null
     */
    private function sizeParameter(): array
    {
        return ['s' => '100'];
    }

    /**
     * @return array
     */
    private function defaultParameter(): array
    {
        return ['d' => $this->settings->get('ianm-gravatar.default')];
    }

    /**
     * @return array|null
     */
    private function ratingParameter(): array
    {
        return ['r' => $this->settings->get('ianm-gravatar.rating')];
    }

    /**
     * @return array|null
     */
    private function forceDefaultParameter()
    {
        if ((bool) $this->settings->get('ianm-gravatar.force-default', false)) {
            return ['forcedefault' => 'y'];
        }

        return null;
    }
}
