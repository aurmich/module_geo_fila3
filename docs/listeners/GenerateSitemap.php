<?php

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
declare(strict_types=1);

=======
>>>>>>> 404660b (up)
=======
declare(strict_types=1);

>>>>>>> 6de787a (up)
=======
declare(strict_types=1);

>>>>>>> fe06862 (.)
namespace App\Listeners;

use Illuminate\Support\Str;
use samdark\sitemap\Sitemap;
use TightenCo\Jigsaw\Jigsaw;

class GenerateSitemap
{
    protected $exclude = [
        '/assets/*',
        '*/favicon.ico',
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
        '*/404',
=======
        '*/404'
>>>>>>> 404660b (up)
=======
        '*/404',
>>>>>>> 6de787a (up)
=======
        '*/404',
>>>>>>> fe06862 (.)
    ];

    public function handle(Jigsaw $jigsaw)
    {
        $baseUrl = $jigsaw->getConfig('baseUrl');

        if (! $baseUrl) {
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
            echo "\nTo generate a sitemap.xml file, please specify a 'baseUrl' in config.php.\n\n";
=======
            echo("\nTo generate a sitemap.xml file, please specify a 'baseUrl' in config.php.\n\n");
>>>>>>> 404660b (up)
=======
            echo "\nTo generate a sitemap.xml file, please specify a 'baseUrl' in config.php.\n\n";
>>>>>>> 6de787a (up)
=======
            echo "\nTo generate a sitemap.xml file, please specify a 'baseUrl' in config.php.\n\n";
>>>>>>> fe06862 (.)

            return;
        }

        $sitemap = new Sitemap($jigsaw->getDestinationPath().'/sitemap.xml');

        collect($jigsaw->getOutputPaths())
            ->reject(function ($path) {
                return $this->isExcluded($path);
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
            })->each(
                function ($path) use ($baseUrl, $sitemap) {
                    $sitemap->addItem(rtrim($baseUrl, '/') . $path, time(), Sitemap::DAILY);
                }
            );
=======
            })->each(function ($path) use ($baseUrl, $sitemap) {
<<<<<<< HEAD
                $sitemap->addItem(rtrim($baseUrl, '/') . $path, time(), Sitemap::DAILY);
        });
>>>>>>> 404660b (up)
=======
=======
            })->each(
function ($path) use ($baseUrl, $sitemap) {
>>>>>>> 2156399 (up)
                $sitemap->addItem(rtrim($baseUrl, '/').$path, time(), Sitemap::DAILY);
            });
>>>>>>> 6de787a (up)
=======
            })->each(
<<<<<<< HEAD
function ($path) use ($baseUrl, $sitemap) {
                $sitemap->addItem(rtrim($baseUrl, '/').$path, time(), Sitemap::DAILY);
            });
>>>>>>> fe06862 (.)
=======
                function ($path) use ($baseUrl, $sitemap) {
                    $sitemap->addItem(rtrim($baseUrl, '/').$path, time(), Sitemap::DAILY);
                }
            );
>>>>>>> 42f9249 (.)

        $sitemap->write();
    }

    public function isExcluded($path)
    {
        return Str::is($this->exclude, $path);
    }
}
