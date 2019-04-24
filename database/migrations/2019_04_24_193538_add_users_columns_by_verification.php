<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Entity\User;

class AddUsersColumnsByVerification extends Migration
{
    private const TABLE_NAME = 'users';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(self::TABLE_NAME, function (Blueprint $table) {
            $table->smallInteger('status');
            $table->string('verify_token')->nullable()->unique();
            $table->smallInteger('role');
        });

        DB::table(self::TABLE_NAME)->update([
            'status' => User::STATUS_ACTIVE,
            'role' => User::ROLE_USER,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(self::TABLE_NAME, function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('verify_token');
            $table->dropColumn('role');
        });
    }
}
