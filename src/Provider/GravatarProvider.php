<?php

/*
 * This file is part of ianm/gravatar.
 *
 * Copyright (c) 2021 IanM.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace IanM\Gravatar\Provider;

use Flarum\Foundation\AbstractServiceProvider;
use IanM\Gravatar\Gravatar;

class GravatarProvider extends AbstractServiceProvider
{
    public function register()
    {
        $this->container->singleton('gravatar', Gravatar::class);
    }
}
