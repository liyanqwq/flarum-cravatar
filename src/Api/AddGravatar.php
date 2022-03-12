<?php

/*
 * This file is part of ianm/gravatar.
 *
 * Copyright (c) 2021 IanM.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace IanM\Gravatar\Api;

use Flarum\Api\Serializer\BasicUserSerializer;
use Flarum\Settings\SettingsRepositoryInterface;
use Flarum\User\User;
use IanM\Gravatar\Gravatar;

class AddGravatar
{
    public Gravatar $gravatar;

    public SettingsRepositoryInterface $settings;

    public function __construct(Gravatar $gravatar, SettingsRepositoryInterface $settings)
    {
        $this->gravatar = $gravatar;
        $this->settings = $settings;
    }

    public function __invoke(BasicUserSerializer $serializer, User $user, array $attributes)
    {
        if (empty($attributes['avatarUrl']) || (bool) $this->settings->get('ianm-gravatar.replace-flarum-custom', false)) {
            $attributes['avatarUrl'] = $this->gravatar->getForUser($user->id);
            $attributes['gravatar'] = true;
        }

        return $attributes;
    }
}
