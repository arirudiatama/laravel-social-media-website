<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Drop foreign key constraint
        DB::statement('ALTER TABLE post_reactions DROP FOREIGN KEY post_reactions_post_id_foreign');

        // Rename column post_id to object_id
        DB::statement('ALTER TABLE post_reactions CHANGE post_id object_id INT UNSIGNED NOT NULL');

        // Add new column object_type
        DB::statement('ALTER TABLE post_reactions ADD object_type VARCHAR(255) AFTER object_id');

        // Rename table to reactions
        DB::statement('RENAME TABLE post_reactions TO reactions');

        // Update object_type values
        DB::table('reactions')->update(['object_type' => 'App\Models\Post']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Rename table to post_reactions
        DB::statement('RENAME TABLE reactions TO post_reactions');

        // Drop object_type column
        DB::statement('ALTER TABLE post_reactions DROP COLUMN object_type');

        // Rename column object_id to post_id
        DB::statement('ALTER TABLE post_reactions CHANGE object_id post_id INT UNSIGNED NOT NULL');

        // Add foreign key constraint
        DB::statement('ALTER TABLE post_reactions ADD CONSTRAINT post_reactions_post_id_foreign FOREIGN KEY (post_id) REFERENCES posts(id)');
    }
};
