
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. USERS
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('phone_number')->unique();
            $table->string('pin_code');
            $table->string('store_name');
            $table->string('owner_name')->nullable();
            $table->string('firebase_uid')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });

        // 2. DEBTORS
        Schema::create('debtors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users');

            $table->string('full_name');
            $table->string('contact_number')->nullable();
            $table->text('address')->nullable();
            $table->text('notes')->nullable();
            $table->decimal('credit_limit', 12, 2)->default(0);
            $table->text('profile_photo_uri')->nullable();
            $table->text('id_photo_uri')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });

        // 3. PRODUCTS
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users');

            $table->string('name');
            $table->string('category')->nullable();
            $table->string('unit')->default('piece');
            $table->decimal('measurement_value', 12, 2)->nullable();
            $table->decimal('unit_price', 12, 2)->default(0);
            $table->decimal('item_price', 12, 2)->nullable();
            $table->integer('stock_quantity')->default(0);
            $table->integer('low_stock_threshold')->default(5);
            $table->string('cloud_id')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });

        // 4. TRANSACTIONS
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users');

            $table->foreignId('debtor_id')
                ->constrained('debtors')
                ->cascadeOnDelete();

            $table->enum('type', ['credit', 'payment']);
            $table->decimal('amount', 12, 2);
            $table->text('description')->nullable();

            $table->foreignId('product_id')
                ->nullable()
                ->constrained('products')
                ->nullOnDelete();

            $table->integer('quantity')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_provider')->nullable();
            $table->string('payment_reference')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });

        // 5. SALES
        Schema::create('sales', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users');

            $table->foreignId('debtor_id')
                ->nullable()
                ->constrained('debtors')
                ->nullOnDelete();

            $table->enum('sale_type', ['cash', 'credit']);
            $table->decimal('total_amount', 12, 2)->default(0);
            $table->string('customer_name')->nullable();
            $table->string('payment_method')->default('cash');
            $table->string('payment_provider')->nullable();
            $table->string('payment_reference')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });

        // 6. SALE ITEMS
        Schema::create('sale_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('sale_id')
                ->constrained('sales')
                ->cascadeOnDelete();

            $table->foreignId('product_id')
                ->nullable()
                ->constrained('products')
                ->nullOnDelete();

            $table->string('product_name');
            $table->decimal('unit_price', 12, 2)->default(0);
            $table->integer('quantity')->default(1);
        });

        // INDEXES
        Schema::table('debtors', function (Blueprint $table) {
            $table->index('user_id');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->index('user_id');
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->index(['user_id', 'debtor_id']);
        });

        Schema::table('sales', function (Blueprint $table) {
            $table->index(['user_id', 'debtor_id']);
        });

        Schema::table('sale_items', function (Blueprint $table) {
            $table->index('product_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sale_items');
        Schema::dropIfExists('transactions');
        Schema::dropIfExists('sales');
        Schema::dropIfExists('products');
        Schema::dropIfExists('debtors');
        Schema::dropIfExists('users');
    }
};
