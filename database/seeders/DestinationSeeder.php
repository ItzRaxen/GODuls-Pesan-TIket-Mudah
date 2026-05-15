<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Seeds the destinations table with the original mock data.
     */
    public function run(): void
    {
        $destinations = [
            [
                'category'    => 'Beach & Island',
                'title'       => 'Bali Paradise Escape',
                'price'       => 2500000,
                'rating'      => 4.8,
                'reviews'     => 1240,
                'image'       => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&q=80&w=800',
                'description' => 'Experience the magical island of Bali with pristine beaches, terraced rice fields, and vibrant culture.',
                'is_active'   => true,
            ],
            [
                'category'    => 'City Tour',
                'title'       => 'Tokyo Explorer Pass',
                'price'       => 4200000,
                'rating'      => 4.9,
                'reviews'     => 892,
                'image'       => 'https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?auto=format&fit=crop&q=80&w=800',
                'description' => 'Explore the fascinating blend of traditional and ultramodern in the electric city of Tokyo.',
                'is_active'   => true,
            ],
            [
                'category'    => 'Nature & Adventure',
                'title'       => 'Swiss Alps Journey',
                'price'       => 8500000,
                'rating'      => 4.7,
                'reviews'     => 567,
                'image'       => 'https://images.unsplash.com/photo-1530122037265-a5f1f91d3b99?auto=format&fit=crop&q=80&w=800',
                'description' => 'Breathtaking alpine scenery, charming villages, and world-class skiing in the heart of Europe.',
                'is_active'   => true,
            ],
            [
                'category'    => 'City Tour',
                'title'       => 'Paris Romance Tour',
                'price'       => 7500000,
                'rating'      => 4.9,
                'reviews'     => 1823,
                'image'       => 'https://images.unsplash.com/photo-1499856871958-5b9627545d1a?auto=format&fit=crop&q=80&w=800',
                'description' => 'The City of Light awaits with its iconic Eiffel Tower, world-class cuisine, and timeless romance.',
                'is_active'   => true,
            ],
            [
                'category'    => 'Beach & Island',
                'title'       => 'Maldives Getaway',
                'price'       => 12000000,
                'rating'      => 5.0,
                'reviews'     => 432,
                'image'       => 'https://images.unsplash.com/photo-1514282401047-d79a71a590e8?auto=format&fit=crop&q=80&w=800',
                'description' => 'Ultimate luxury in paradise with crystal-clear lagoons, overwater bungalows, and vibrant marine life.',
                'is_active'   => true,
            ],
            [
                'category'    => 'Nature & Adventure',
                'title'       => 'Kenya Safari Experience',
                'price'       => 9500000,
                'rating'      => 4.8,
                'reviews'     => 298,
                'image'       => 'https://images.unsplash.com/photo-1516426122078-c23e76319801?auto=format&fit=crop&q=80&w=800',
                'description' => 'Witness the Great Migration and encounter Africa\'s Big Five in their natural habitat.',
                'is_active'   => true,
            ],
            [
                'category'    => 'Beach & Island',
                'title'       => 'Santorini Sunset',
                'price'       => 8200000,
                'rating'      => 4.7,
                'reviews'     => 712,
                'image'       => 'https://images.unsplash.com/photo-1533105079780-92b9be482077?auto=format&fit=crop&q=80&w=800',
                'description' => 'Iconic white-washed buildings, blue-domed churches, and spectacular caldera sunsets in Greece.',
                'is_active'   => true,
            ],
            [
                'category'    => 'City Tour',
                'title'       => 'New York City Lights',
                'price'       => 6800000,
                'rating'      => 4.6,
                'reviews'     => 1456,
                'image'       => 'https://images.unsplash.com/photo-1496442226666-8d4d0e62e6e9?auto=format&fit=crop&q=80&w=800',
                'description' => 'The city that never sleeps — iconic skyline, Broadway shows, world-class museums, and incredible food.',
                'is_active'   => true,
            ],
            [
                'category'    => 'Nature & Adventure',
                'title'       => 'Patagonia Hiking',
                'price'       => 10500000,
                'rating'      => 4.9,
                'reviews'     => 189,
                'image'       => 'https://images.unsplash.com/photo-1534481418361-125010091814?auto=format&fit=crop&q=80&w=800',
                'description' => 'Trek through some of the most dramatic landscapes on Earth at the southern tip of South America.',
                'is_active'   => true,
            ],
        ];

        DB::table('destinations')->insert($destinations);
    }
}
