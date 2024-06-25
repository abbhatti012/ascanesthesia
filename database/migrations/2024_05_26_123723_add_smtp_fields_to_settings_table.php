<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class AddSmtpFieldsToSettingsTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::table('settings', function (Blueprint $table) {
                $table->string('smtp_host')->nullable();
                $table->string('smtp_port')->nullable();
                $table->string('smtp_username')->nullable();
                $table->string('smtp_password')->nullable();
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::table('settings', function (Blueprint $table) {
                $table->dropColumn('smtp_host');
                $table->dropColumn('smtp_port');
                $table->dropColumn('smtp_username');
                $table->dropColumn('smtp_password');
            });
        }
    }
