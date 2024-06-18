<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;

class EagerLoadingTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:eager-loading-test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
	dump('Lazy loading:');

        Auth::login(User::find(1));
        dump('Authenticated user: '.Auth::user()->id);
        Category::get()->each(
            fn(Category $category) => dump(sprintf('- %s: %d examples', $category->name, $category->examples->count()))
        );

        // --

        Auth::login(User::find(2));
        dump('Authenticated user: '.Auth::user()->id);
        Category::get()->each(
            fn(Category $category) => dump(sprintf('- %s: %d examples', $category->name, $category->examples->count()))
        );

	// -- 

	dump('Eager loading:');

	Auth::login(User::find(1));
        dump('Authenticated user: '.Auth::user()->id);
        Category::with('examples')->get()->each(
            fn(Category $category) => dump(sprintf('- %s: %d examples', $category->name, $category->examples->count()))
        );

        // --

        Auth::login(User::find(2));
        dump('Authenticated user: '.Auth::user()->id);
        Category::with('examples')->get()->each(
            fn(Category $category) => dump(sprintf('- %s: %d examples', $category->name, $category->examples->count()))
        );


    }
}
