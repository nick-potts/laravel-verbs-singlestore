<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Thunk\Verbs\Facades\Id;

return new class extends Migration
{
    public function up()
    {
        Schema::create($this->tableName(), function (Blueprint $table) {
            // The 'id' column needs to be set up differently depending
            // on if you're using Snowflakes vs. ULIDs/etc.
            $idColumn = Id::createColumnDefinition($table)->index();

            $table->string('type')->index();
            $table->json('data');

            $table->snowflake('last_event_id')->nullable();

            $table->timestamps();

            $table->unique([$idColumn->get('name', 'id'), 'type']);

            if ($table instanceof \SingleStore\Laravel\Schema\Blueprint) {
                $table->shardKey($idColumn->get('name', 'id'));
                $table->sortKey('type');
            }
        });
    }

    public function down()
    {
        Schema::dropIfExists($this->tableName());
    }

    protected function tableName(): string
    {
        return config('verbs.tables.snapshots', 'verb_snapshots');
    }
};
