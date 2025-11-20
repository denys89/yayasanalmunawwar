<?php

namespace App\Helpers;

class IconHelper
{
    /**
     * Get all available icons organized by categories
     * 
     * @return array
     */
    public static function getIconCategories()
    {
        $flaticonAll = self::getProjectFlaticonIcons();

        return [
            'general' => [
                'title' => 'General Icons',
                'icon' => 'fa-solid fa-star',
                'color' => 'orange',
                'icons' => [
                    ['class' => 'flaticon-globe', 'name' => 'Globe'],
                    ['class' => 'flaticon-user', 'name' => 'User'],
                    ['class' => 'flaticon-phone', 'name' => 'Phone'],
                    ['class' => 'flaticon-email', 'name' => 'Email'],
                    ['class' => 'flaticon-share', 'name' => 'Social Media'],
                    ['class' => 'flaticon-maps-and-flags', 'name' => 'Location'],
                    ['class' => 'flaticon-mosque', 'name' => 'Home'],
                    ['class' => 'flaticon-star', 'name' => 'Heart'],
                    ['class' => 'flaticon-time-management', 'name' => 'Calendar'],
                    ['class' => 'flaticon-education', 'name' => 'Clock'],
                ]
            ],
            'flaticon_all' => [
                'title' => 'All Flaticon Icons',
                'icon' => 'fa-solid fa-icons',
                'color' => 'blue',
                'icons' => $flaticonAll,
            ],
            'islamic' => [
                'title' => 'Islamic & Religious',
                'icon' => 'fa-solid fa-mosque',
                'color' => 'green',
                'icons' => [
                    ['class' => 'flaticon-allah', 'name' => 'Allah'],
                    ['class' => 'flaticon-quran', 'name' => 'Quran Book'],
                    ['class' => 'flaticon-praying', 'name' => 'Prayer'],
                    ['class' => 'flaticon-praying', 'name' => 'Praying'],
                    ['class' => 'flaticon-mosque', 'name' => 'Mosque'],
                    ['class' => 'flaticon-nabawi-mosque', 'name' => 'Nabawi'],
                    ['class' => 'flaticon-islamic', 'name' => 'Islamic'],
                    ['class' => 'flaticon-islam', 'name' => 'Islam'],
                    ['class' => 'flaticon-islamic-lantern', 'name' => 'Islamic Lantern'],
                    ['class' => 'flaticon-quran-1', 'name' => 'Quran 1'],
                    ['class' => 'flaticon-quran-2', 'name' => 'Quran 2'],
                    ['class' => 'flaticon-quran-3', 'name' => 'Quran 3'],
                    ['class' => 'flaticon-quran-4', 'name' => 'Quran 4'],
                    ['class' => 'flaticon-quran-5', 'name' => 'Quran 5'],
                    ['class' => 'flaticon-quran-6', 'name' => 'Quran 6'],
                    ['class' => 'flaticon-quran-7', 'name' => 'Quran 7'],
                    ['class' => 'flaticon-mosque-1', 'name' => 'Mosque 1'],
                    ['class' => 'flaticon-mosque-2', 'name' => 'Mosque 2'],
                    ['class' => 'flaticon-mosque-3', 'name' => 'Mosque 3'],
                    ['class' => 'flaticon-mosque-4', 'name' => 'Mosque 4'],
                    ['class' => 'flaticon-pray', 'name' => 'Pray'],
                    ['class' => 'flaticon-pray-1', 'name' => 'Pray 1'],
                    ['class' => 'flaticon-praying-1', 'name' => 'Praying 1'],
                    ['class' => 'flaticon-hijab', 'name' => 'Hijab'],
                    ['class' => 'flaticon-iso', 'name' => 'ISO'],
                ]
            ],
            'educational' => [
                'title' => 'Educational',
                'icon' => 'fa-solid fa-graduation-cap',
                'color' => 'blue',
                'icons' => [
                    ['class' => 'flaticon-education', 'name' => 'Education'],
                    ['class' => 'flaticon-book', 'name' => 'Book'],
                    ['class' => 'flaticon-read', 'name' => 'Reading'],
                    ['class' => 'flaticon-time-management', 'name' => 'Time Management'],
                    ['class' => 'flaticon-boy', 'name' => 'Boy'],
                ]
            ],
            'values' => [
                'title' => 'General Values',
                'icon' => 'fa-solid fa-heart',
                'color' => 'purple',
                'icons' => [
                    ['class' => 'flaticon-star', 'name' => 'Star'],
                    ['class' => 'flaticon-give', 'name' => 'Giving'],
                ]
            ],
            'communication' => [
                'title' => 'Communication',
                'icon' => 'fa-solid fa-phone',
                'color' => 'teal',
                'icons' => [
                    ['class' => 'flaticon-phone-call', 'name' => 'Phone Call'],
                    ['class' => 'flaticon-call', 'name' => 'Call'],
                    ['class' => 'flaticon-smartphone', 'name' => 'Smartphone'],
                    ['class' => 'flaticon-telephone', 'name' => 'Telephone'],
                    ['class' => 'flaticon-envelope', 'name' => 'Envelope'],
                ]
            ],
            'social' => [
                'title' => 'Social Media',
                'icon' => 'fa-solid fa-share-nodes',
                'color' => 'pink',
                'icons' => [
                    ['class' => 'flaticon-facebook-app-symbol', 'name' => 'Facebook'],
                    ['class' => 'flaticon-twitter', 'name' => 'Twitter'],
                    ['class' => 'flaticon-linkedin', 'name' => 'LinkedIn'],
                    ['class' => 'flaticon-instagram', 'name' => 'Instagram'],
                    ['class' => 'flaticon-whatsapp', 'name' => 'WhatsApp'],
                    ['class' => 'flaticon-tik-tok', 'name' => 'TikTok'],
                ]
            ],
            'navigation' => [
                'title' => 'Navigation',
                'icon' => 'fa-solid fa-compass',
                'color' => 'blue',
                'icons' => [
                    ['class' => 'flaticon-up-right-arrow', 'name' => 'Up Right Arrow'],
                    ['class' => 'flaticon-next', 'name' => 'Next'],
                    ['class' => 'flaticon-back', 'name' => 'Back'],
                    ['class' => 'flaticon-up-arrow', 'name' => 'Up'],
                    ['class' => 'flaticon-down-arrow', 'name' => 'Down'],
                ]
            ],
            'interface' => [
                'title' => 'Interface',
                'icon' => 'fa-solid fa-desktop',
                'color' => 'purple',
                'icons' => [
                    ['class' => 'flaticon-menu', 'name' => 'Menu'],
                    ['class' => 'flaticon-settings', 'name' => 'Settings'],
                    ['class' => 'flaticon-search', 'name' => 'Search'],
                    ['class' => 'flaticon-close', 'name' => 'Close'],
                ]
            ]
        ];
    }

    /**
     * Extract available Flaticon classes from project CSS
     * @return array<int, array{class:string,name:string}>
     */
    public static function getProjectFlaticonIcons(): array
    {
        try {
            $files = glob(public_path('assets/css/flaticon_*.css')) ?: [];
            if (empty($files)) {
                $files = glob(public_path('css/flaticon_*.css')) ?: [];
            }
            $path = $files[0] ?? null;
            if (!$path || !is_readable($path)) {
                return [];
            }
            $css = file_get_contents($path);
            if ($css === false) {
                return [];
            }
            $icons = [];
            if (preg_match_all('/\.flaticon-([a-z0-9\-]+)\s*:\s*before/iu', $css, $matches)) {
                foreach ($matches[1] as $name) {
                    $class = 'flaticon-' . $name;
                    $pretty = ucwords(str_replace(['-', '_'], ' ', $name));
                    $icons[] = ['class' => $class, 'name' => $pretty];
                }
            }
            return $icons;
        } catch (\Throwable $e) {
            return [];
        }
    }

    /**
     * Get color classes for a specific color
     * 
     * @param string $color
     * @return array
     */
    public static function getColorClasses($color)
    {
        $colorMap = [
            'orange' => [
                'border' => 'border-orange-400',
                'bg' => 'bg-orange-50',
                'text' => 'text-orange-600'
            ],
            'green' => [
                'border' => 'border-green-400',
                'bg' => 'bg-green-50',
                'text' => 'text-green-600'
            ],
            'blue' => [
                'border' => 'border-blue-400',
                'bg' => 'bg-blue-50',
                'text' => 'text-blue-600'
            ],
            'purple' => [
                'border' => 'border-purple-400',
                'bg' => 'bg-purple-50',
                'text' => 'text-purple-600'
            ],
            'teal' => [
                'border' => 'border-teal-400',
                'bg' => 'bg-teal-50',
                'text' => 'text-teal-600'
            ],
            'pink' => [
                'border' => 'border-pink-400',
                'bg' => 'bg-pink-50',
                'text' => 'text-pink-600'
            ]
        ];

        return $colorMap[$color] ?? $colorMap['blue'];
    }
}