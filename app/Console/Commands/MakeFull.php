<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeFull extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:fullSection {name=name} {arSingleName=arSingleName} {arpluraleName=arpluraleName} {--seed} {--request} {--resource} {--inputs}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $vars = [];

        $vars['M_odel'] = $this->argument('name');  // ex : BankAccount
        $vars['arSingleName'] = $this->argument('arSingleName');
        $vars['arpluraleName'] = $this->argument('arpluraleName');

        if ($this->confirm('sure you want to continue with name ' . $vars['M_odel'], true)) {
            $vars['folderName'] = Str::snake($vars['M_odel']);   // ex : bank_account
            $vars['modelSnakeCase'] = Str::snake($vars['M_odel']);  // ex : bank_account
            $vars['modelPluralSnakeCase'] = Str::plural(Str::snake($vars['modelSnakeCase']));  // ex : bank_accounts
            $vars['modelKebabCase'] = Str::snake($vars['M_odel'], '-'); // ex : bank-account
            $vars['modelKebabPluralName'] = Str::plural($vars['modelKebabCase']); // ex : bank-accounts
            $vars['modelPluralModelName'] = Str::plural($vars['M_odel']); // ex : BankAccounts
            $vars['modelSingleOriginalName'] = Str::singular($vars['modelPluralModelName']); // ex : BankAccount
            $vars['modelPascalCaseSingleName'] =  Str::headline($vars['modelSingleOriginalName']);   // ex : Bank Account
            $vars['modelPascalCasePluralName'] =  Str::headline($vars['modelPluralModelName']);   // ex : Bank Accounts

            $replacements = [
                '/M_odel/'                  => $vars['M_odel'],
                '/arSingleName/'            => $vars['arSingleName'],
                '/arpluraleName/'           => $vars['arpluraleName'],
                '/folderName/'              => $vars['folderName'],
                '/modelSnakeCase/'          => $vars['modelSnakeCase'],
                '/modelPluralSnakeCase/'    => $vars['modelPluralSnakeCase'],
                '/modelKebabCase/'          => $vars['modelKebabCase'],
                '/modelKebabPluralName/'    => $vars['modelKebabPluralName'],
                '/modelPluralModelName/'    => $vars['modelPluralModelName'],
                '/modelSingleOriginalName/' => $vars['modelSingleOriginalName'],
            ];


            // create Model
            $this->makeModel($vars, $replacements);

            // create Controller
            $this->makeController($vars, $replacements);

            // create Views
            $this->makeViews($vars, $replacements);

            // create Routes
            $this->makeRoutes($vars, $replacements);
            $this->makeSideBar($vars, $replacements);

            // create Translations
            $this->makeTranslations($vars, $replacements);


            // create seeder (optional)
            if ($this->option('seed')) {
                Artisan::call('make:seeder', [ 'name' => $vars['M_odel'] . 'TableSeeder' ]);
            }
            // #create seeder (optional)

            // create request (optional)
            if ($this->option('request')) {
                Artisan::call('make:request', [ 'name' => 'Admin/' . $vars['folderName'] . '/Store' ]);
                Artisan::call('make:request', [ 'name' => 'Admin/' . $vars['folderName'] . '/Update' ]);

                File::copy('app/Http/Requests/Admin/store_copy.php', base_path('app/Http/Requests/Admin/' . $vars['folderName'] . '/Store.php'));
                file_put_contents('app/Http/Requests/Admin/' . $vars['folderName'] . '/Store.php', preg_replace("/Copy/", $vars['folderName'], file_get_contents('app/Http/Requests/Admin/' . $vars['folderName'] . '/Store.php')));

                File::copy('app/Http/Requests/Admin/update_copy.php', base_path('app/Http/Requests/Admin/' . $vars['folderName'] . '/Update.php'));
                file_put_contents('app/Http/Requests/Admin/' . $vars['folderName'] . '/Update.php', preg_replace("/Copy/", $vars['folderName'], file_get_contents('app/Http/Requests/Admin/' . $vars['folderName'] . '/Update.php')));
            }
            // #create request (optional)

            // create request (optional)
            if ($this->option('resource')) {
                Artisan::call('make:resource', [ 'name' => 'Api/' . $vars['M_odel'] . 'Resource' ]);
            }
            // #create request (optional)


            Artisan::call('db:seed', [ '--class' => 'PermissionTableSeeder' ]);
            Artisan::call('optimize:clear');

            // call back
            $this->info('New Repository , Interface , Dashboard Controller , Model , DataBase Migrate , optional commands [ database seeder , admin section form request , observer] , Blade Folder And Blade File on dashboard , basic [index - store - update - delete] routes in web.php file for dashboard are created successfully ! ');
            // #call back
        }
    }


    protected function makeModel($vars, $replacements)
    {
        Artisan::call('make:model', [ 'name' => $vars['M_odel'], '-m' => true ]);
        File::copy('app/Models/copy.php', base_path('app/Models/' . $vars['M_odel'] . '.php'));
        $filePath = 'app/Models/' . $vars['M_odel'] . '.php';
        $fileContent = file_get_contents($filePath);
        $replacements = [
            '/Copy/'  => $vars['M_odel'],
            '/copys/' => $vars['folderName'],
        ];
        $fileContent = preg_replace(array_keys($replacements), array_values($replacements), $fileContent);
        file_put_contents($filePath, $fileContent);
    }

    protected function makeController($vars, $replacements)
    {
        Artisan::call('make:controller', [ 'name' => 'Admin/' . $vars['M_odel'] . 'Controller' ]);
        if ($this->option('inputs')) {
            File::copy('app/Http/Controllers/Admin/inputsCopyController.php', base_path('app/Http/Controllers/Admin/' . $vars['M_odel'] . 'Controller.php'));
        } else {
            File::copy('app/Http/Controllers/Admin/CopyController.php', base_path('app/Http/Controllers/Admin/' . $vars['M_odel'] . 'Controller.php'));
        }

        $filePath = 'app/Http/Controllers/Admin/' . $vars['M_odel'] . 'Controller.php';
        $fileContent = file_get_contents($filePath);
        $fileContent = preg_replace(array_keys($replacements), array_values($replacements), $fileContent);
        file_put_contents($filePath, $fileContent);


    }

    protected function makeRoutes($vars, $replacements)
    {
        file_put_contents(
            'routes/dashboard.php',
            preg_replace(
                "/#new_routes_here/",
                "   
        /*------------ " . $vars['modelKebabPluralName'] . "  ----------*/
        Route::post('" . $vars['modelKebabPluralName'] . "-deleteAll', [ " . $vars['M_odel'] . "Controller::class, 'destroyAll' ])->name('" . $vars['modelKebabPluralName'] . ".deleteAll');
        Route::resource('" . $vars['modelKebabPluralName'] . "', " . $vars['M_odel'] . "Controller::class);
        #new_routes_here
        ",
                file_get_contents('routes/dashboard.php')
            )
        );

        file_put_contents(
            'routes/dashboard.php',
            preg_replace(
                "/#new_namespace_here/",
                "   
             " . $vars['M_odel'] . "Controller,
        #new_namespace_here
        ",
                file_get_contents('routes/dashboard.php')
            )
        );

    }

    protected function makeSideBar($vars, $replacements)
    {
        $sideBar = 'resources/views/admin/layout/partial/sidebar.blade.php';
        $contents = file_get_contents($sideBar);

        // The new sidebar element to be added, with interpolation of $this->modelObject
        $text = "
       @can('read-{$vars['modelKebabCase']}')
            <li class=\" @if(Route::currentRouteName() == 'admin.{$vars['modelKebabPluralName']}.index') active @endif\">
                <a href=\"{{ route('admin.{$vars['modelKebabPluralName']}.index') }}\">
                    <i class=\"feather icon-circle\"></i> @lang('admin.{$vars['modelKebabPluralName']}.index')
                </a>
            </li>
        @endcan
";

        // Prepare the translations with the new sidebar element
        $translations = $text . "
{{--#new_comand_side_bar_element_here--}}
";

        // Replace the placeholder with the new sidebar element
        $newContents = preg_replace(
            "/{{--#new_comand_side_bar_element_here--}}/",
            $translations,
            $contents
        );
        // Write the updated contents back to the sidebar file
        file_put_contents($sideBar, $newContents);
    }


    protected function makeTranslations($vars, $replacements)
    {

        file_put_contents(
            'resources/lang/ar/admin.php',
            preg_replace(
                "/#new_comand_translations_here/",
                "
    '" . $vars['modelKebabPluralName'] . "' => [
        'index'    => '" . $vars['arpluraleName'] . "',
        'create'   => 'اضافة " . $vars['arSingleName'] . "',
        'edit'     => 'تعديل " . $vars['arSingleName'] . "',
        'update'   => 'تعديل " . $vars['arSingleName'] . "',
        'read'     => 'عرض " . $vars['arSingleName'] . "',
        'read-all' => 'عرض جميع " . $vars['arpluraleName'] . "',
        'delete'   => 'حذف " . $vars['arSingleName'] . "',
    ],
    
    '" . $vars['modelKebabPluralName'] . "' => [
        'index'  => '" . $vars['arpluraleName'] . "',
        'create' => 'اضافة " . $vars['arSingleName'] . "',
        'edit'   => 'تعديل " . $vars['arSingleName'] . "',
        'show'   => 'عرض " . $vars['arSingleName'] . "',
    ],
    
    #new_comand_translations_here
    ",
                file_get_contents('resources/lang/ar/admin.php'))
        );
        file_put_contents(
            'resources/lang/en/admin.php',
            preg_replace(
                "/#new_comand_translations_here/",
                "
    '" . $vars['modelKebabPluralName'] . "' => [
        'index'    => '" . $vars['modelPascalCasePluralName'] . "',
        'create'   => 'Add " . $vars['modelPascalCaseSingleName'] . "',
        'edit'     => 'Edit " . $vars['modelPascalCaseSingleName'] . "',
        'update'   => 'Update " . $vars['modelPascalCaseSingleName'] . "',
        'read'     => 'View " . $vars['modelPascalCaseSingleName'] . "',
        'read-all' => 'View all " . $vars['modelPascalCaseSingleName'] . "',
        'delete'   => 'Delete " . $vars['modelPascalCaseSingleName'] . "',
        'read-all-intro-settings' => 'View " . $vars['modelPascalCasePluralName'] . "',
        'read-all-dashboard-settings' => 'View " . $vars['modelPascalCasePluralName'] . "',
    ],
    '" . $vars['modelKebabPluralName'] . "' => [
        'index'  => '" . $vars['modelPascalCasePluralName'] . "',
        'create' => 'Add " . $vars['modelPascalCaseSingleName'] . "',
        'edit'   => 'Edit " . $vars['modelPascalCaseSingleName'] . "',
        'show'   => 'View " . $vars['modelPascalCaseSingleName'] . "',
    ],

    #new_comand_translations_here
    ",
                file_get_contents('resources/lang/en/admin.php')
            )
        );


    }

    protected function makeViews($vars, $replacements)
    {


        //check if directory exist
        if (!File::exists('resources/views/admin/' . $vars['folderName'])) {
            File::makeDirectory('resources/views/admin/' . $vars['folderName']);
        }


        // create index page //


        if ($this->option('inputs')) {
            File::copy('resources/views/admin/shared/inputsCopys/index.blade.php', base_path('resources/views/admin/' . $vars['folderName'] . '/index.blade.php'));
        } else {
            File::copy('resources/views/admin/shared/copys/index.blade.php', base_path('resources/views/admin/' . $vars['folderName'] . '/index.blade.php'));
        }
        file_put_contents(
            'resources/views/admin/' . $vars['folderName'] . '/index.blade.php'
            , preg_replace(
                "/folderName/"
                , $vars['folderName'],
                file_get_contents('resources/views/admin/' . $vars['folderName'] . '/index.blade.php')
            )
        );
        file_put_contents(
            'resources/views/admin/' . $vars['folderName'] . '/index.blade.php'
            , preg_replace(
                "/modelKebabPluralName/"
                , $vars['modelKebabPluralName'],
                file_get_contents('resources/views/admin/' . $vars['folderName'] . '/index.blade.php')
            )
        );


        // # create index page //

        // create form page
        if ($this->option('inputs')) {
            File::copy('resources/views/admin/shared/inputsCopys/create.blade.php', base_path('resources/views/admin/' . $vars['folderName'] . '/create.blade.php'));
        } else {
            File::copy('resources/views/admin/shared/copys/create.blade.php', base_path('resources/views/admin/' . $vars['folderName'] . '/create.blade.php'));
        }

        $filePath = 'resources/views/admin/' . $vars['folderName'] . '/create.blade.php';
        $fileContent = file_get_contents($filePath);
        $replacements = [
            '/modelKebabCase/'       => $vars['modelKebabCase'],
            '/modelSnakeCase/'       => $vars['modelSnakeCase'],
            '/modelPluralSnakeCase/' => $vars['modelPluralSnakeCase'],
            '/modelKebabPluralName/' => $vars['modelKebabPluralName'],
            '/arSingleName/'         => $vars['arSingleName'],
        ];
        $fileContent = preg_replace(array_keys($replacements), array_values($replacements), $fileContent);
        file_put_contents($filePath, $fileContent);


        // #create  form page //

        // create edit form page //
        if ($this->option('inputs')) {
            File::copy('resources/views/admin/shared/inputsCopys/edit.blade.php', base_path('resources/views/admin/' . $vars['folderName'] . '/edit.blade.php'));
        } else {
            File::copy('resources/views/admin/shared/copys/edit.blade.php', base_path('resources/views/admin/' . $vars['folderName'] . '/edit.blade.php'));
        }

        $filePath = 'resources/views/admin/' . $vars['folderName'] . '/edit.blade.php';
        $fileContent = file_get_contents($filePath);
        $fileContent = preg_replace(array_keys($replacements), array_values($replacements), $fileContent);
        file_put_contents($filePath, $fileContent);

        // create edit form page //

        // create show page //
        if ($this->option('inputs')) {
            File::copy('resources/views/admin/shared/inputsCopys/show.blade.php', base_path('resources/views/admin/' . $vars['folderName'] . '/show.blade.php'));
        } else {
            File::copy('resources/views/admin/shared/copys/show.blade.php', base_path('resources/views/admin/' . $vars['folderName'] . '/show.blade.php'));
        }

        file_put_contents(
            'resources/views/admin/' . $vars['folderName'] . '/show.blade.php'
            , preg_replace(array_keys($replacements), array_values($replacements), file_get_contents('resources/views/admin/' . $vars['folderName'] . '/show.blade.php')
            )
        );

        file_put_contents(
            'resources/views/admin/' . $vars['folderName'] . '/show.blade.php'
            , preg_replace(array_keys($replacements), array_values($replacements), file_get_contents('resources/views/admin/' . $vars['folderName'] . '/show.blade.php')
            )
        );
        // create show page //

        if ($this->option('inputs')) {
            File::copy('resources/views/admin/shared/inputsCopys/table.blade.php', base_path('resources/views/admin/' . $vars['folderName'] . '/table.blade.php'));
        } else {
            File::copy('resources/views/admin/shared/copys/table.blade.php', base_path('resources/views/admin/' . $vars['folderName'] . '/table.blade.php'));
        }

        // File path
        $filePath = 'resources/views/admin/' . $vars['folderName'] . '/table.blade.php';
        $fileContent = file_get_contents($filePath);
        $fileContent = preg_replace(array_keys($replacements), array_values($replacements), $fileContent);
        file_put_contents($filePath, $fileContent);


        // #create table blade page

    }
}
