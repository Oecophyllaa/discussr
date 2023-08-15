<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		DB::table('categories')->insert([
			[
				'slug' => 'technology',
				'name' => 'Technology'
			],
			[
				'slug' => 'dating',
				'name' => 'Dating'
			],
			[
				'slug' => 'science',
				'name' => 'Science'
			],
			[
				'slug' => 'education',
				'name' => 'Education'
			],
			[
				'slug' => 'health',
				'name' => 'Health'
			],
			[
				'slug' => 'books',
				'name' => 'Books'
			],
			[
				'slug' => 'personal',
				'name' => 'Personal'
			],
			[
				'slug' => 'food',
				'name' => 'Food'
			],
			[
				'slug' => 'research',
				'name' => 'Research'
			],
			[
				'slug' => 'history',
				'name' => 'History'
			],
			[
				'slug' => 'sports',
				'name' => 'Sports'
			],
			[
				'slug' => 'other',
				'name' => 'Other'
			],
		]);
	}
}
