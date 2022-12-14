<?php

namespace Efficon\JWTAuth;

use Config;
use System\Classes\PluginBase;
use System\Classes\SettingsManager;
use Efficon\JWTAuth\Models\Settings as PluginSettings;

/**
 * JWTAuth Plugin Information File.
 */
class Plugin extends PluginBase
{
    /**
     * Plugin dependencies.
     *
     * @var array
     */
    public $require = ['RainLab.User'];

   

    /**
     * Register the plugin settings
     *
     * @return array
     */
    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'efficon.jwtauth::lang.settings.menu_label',
                'description' => 'efficon.jwtauth::lang.settings.menu_description',
                'category'    => SettingsManager::CATEGORY_USERS,
                'icon'        => 'icon-user-secret',
                'class'       => 'Efficon\JWTAuth\Models\Settings',
                'order'       => 600,
                'permissions' => ['efficon.jwtauth.access_settings'],
            ]
        ];
    }

    /**
     * Register the plugin permissions
     *
     * @return array
     */
    public function registerPermissions()
    {
        return [
            'efficon.jwtauth.access_settings' => [
                'tab' => 'efficon.jwtauth::lang.plugin.name',
                'label' => 'efficon.jwtauth::lang.permissions.settings'
            ]
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(\Efficon\JWTAuth\Providers\AuthServiceProvider::class);
        $this->app->alias('JWTAuth', \Efficon\JWTAuth\Facades\JWTAuth::class);

        // Handle error
        $this->app->error(function (\Exception $e) {
            if (!request()->isJson()) {
                return;
            }

            return [
                'error' => [
                    'code' => 'internal_error',
                    'http_code' => 500,
                    'message' => $e->getMessage(),
                ],
            ];
        });
    }
}
