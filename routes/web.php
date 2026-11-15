
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\SignupController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DebtorsController;
use App\Http\Controllers\DebtorDetailController;
use App\Http\Controllers\AddCreditController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\SellCartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ReportsController;

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

// Login
Route::get('/login', [LoginController::class, 'show'])
    ->name('login');

Route::post('/login', [LoginController::class, 'login'])
    ->name('login.submit');

// Signup
// FIXED: Changed showSignupForm() to show()
Route::get('/signup', [SignupController::class, 'show'])
    ->name('signup');

// FIXED: Changed signup() to register()
Route::post('/signup', [SignupController::class, 'register'])
    ->name('signup.store');

// Logout
Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');


/*
|--------------------------------------------------------------------------
| Default Route
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});


/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');


/*
|--------------------------------------------------------------------------
| Profile Routes
|--------------------------------------------------------------------------
*/

Route::get('/profile', [ProfileController::class, 'index'])
    ->name('profile.index');

Route::post('/profile/update', [ProfileController::class, 'update'])
    ->name('profile.update');

Route::post('/profile/password', [ProfileController::class, 'updatePassword'])
    ->name('profile.password');


/*
|--------------------------------------------------------------------------
| Debtor Routes
|--------------------------------------------------------------------------
*/

Route::get('/debtors', [DebtorsController::class, 'index'])
    ->name('debtors.index');

Route::get('/debtors/create', [DebtorsController::class, 'create'])
    ->name('debtors.create');

Route::post('/debtors', [DebtorsController::class, 'store'])
    ->name('debtors.store');

Route::get('/debtors/{id}/edit', [DebtorsController::class, 'edit'])
    ->whereNumber('id')
    ->name('debtors.edit');

Route::put('/debtors/{id}', [DebtorsController::class, 'update'])
    ->whereNumber('id')
    ->name('debtors.update');

Route::get('/debtors/{id}', [DebtorDetailController::class, 'show'])
    ->whereNumber('id')
    ->name('debtors.show');

Route::delete('/debtors/{id}', [DebtorDetailController::class, 'destroy'])
    ->whereNumber('id')
    ->name('debtors.destroy');

Route::delete(
    '/debtors/{id}/transactions/{transactionId}',
    [DebtorDetailController::class, 'destroyTransaction']
)
    ->whereNumber('id')
    ->whereNumber('transactionId')
    ->name('debtors.transactions.destroy');


/*
|--------------------------------------------------------------------------
| Add Credit Routes
|--------------------------------------------------------------------------
*/

Route::get('/debtors/{debtor}/add-credit', [AddCreditController::class, 'create'])
    ->whereNumber('debtor')
    ->name('debtors.credit.create');

Route::post('/debtors/{debtor}/add-credit', [AddCreditController::class, 'store'])
    ->whereNumber('debtor')
    ->name('debtors.credit.store');


/*
|--------------------------------------------------------------------------
| Debtor Payment Routes
|--------------------------------------------------------------------------
*/

Route::get('/debtors/{debtorId}/payments/create', [PaymentController::class, 'create'])
    ->whereNumber('debtorId')
    ->name('debtors.payments.create');

Route::post('/debtors/{debtorId}/payments', [PaymentController::class, 'store'])
    ->whereNumber('debtorId')
    ->name('debtors.payments.store');


/*
|--------------------------------------------------------------------------
| Inventory Routes
|--------------------------------------------------------------------------
*/

Route::get('/inventory', [InventoryController::class, 'index'])
    ->name('inventory.index');

Route::get('/inventory/new', [InventoryController::class, 'create'])
    ->name('inventory.create');

Route::post('/inventory', [InventoryController::class, 'store'])
    ->name('inventory.store');

Route::get('/inventory/{id}/edit', [InventoryController::class, 'edit'])
    ->whereNumber('id')
    ->name('inventory.edit');

Route::put('/inventory/{id}', [InventoryController::class, 'update'])
    ->whereNumber('id')
    ->name('inventory.update');

Route::delete('/inventory/{id}', [InventoryController::class, 'destroy'])
    ->whereNumber('id')
    ->name('inventory.destroy');


/*
|--------------------------------------------------------------------------
| Inventory Compatibility Route
|--------------------------------------------------------------------------
*/

Route::get('/inventory/{id}', function ($id) {
    return redirect()->route('inventory.edit', ['id' => $id]);
})
    ->whereNumber('id')
    ->name('inventory.show');


/*
|--------------------------------------------------------------------------
| Sell Products Routes
|--------------------------------------------------------------------------
*/

Route::get('/sell', [SellController::class, 'index'])
    ->name('sell.index');


/*
|--------------------------------------------------------------------------
| Shopping Cart Routes
|--------------------------------------------------------------------------
*/

Route::get('/sell/cart', [SellCartController::class, 'index'])
    ->name('sell.cart');

Route::post('/sell/cart/add/{id}', [SellCartController::class, 'add'])
    ->whereNumber('id')
    ->name('sell.cart.add');

Route::patch('/sell/cart/update/{id}', [SellCartController::class, 'update'])
    ->whereNumber('id')
    ->name('sell.cart.update');

Route::delete('/sell/cart/remove/{id}', [SellCartController::class, 'remove'])
    ->whereNumber('id')
    ->name('sell.cart.remove');

Route::delete('/sell/cart/clear', [SellCartController::class, 'clear'])
    ->name('sell.cart.clear');


/*
|--------------------------------------------------------------------------
| Checkout Routes
|--------------------------------------------------------------------------
*/

Route::get('/sell/checkout', [CheckoutController::class, 'index'])
    ->name('sell.checkout');

Route::post('/sell/checkout/complete', [CheckoutController::class, 'complete'])
    ->name('sell.complete');

Route::get('/sell/receipt/{id}', [CheckoutController::class, 'receipt'])
    ->whereNumber('id')
    ->name('sell.receipt');


/*
|--------------------------------------------------------------------------
| Reports Routes
|--------------------------------------------------------------------------
*/

Route::get('/reports', [ReportsController::class, 'index'])
    ->name('reports.index');

Route::get('/reports/print', [ReportsController::class, 'print'])
    ->name('reports.print');

Route::delete('/reports/history', [ReportsController::class, 'clearHistory'])
    ->name('reports.history.clear');

Route::delete('/reports/history/{source}/{id}', [ReportsController::class, 'deleteHistoryEntry'])
    ->whereIn('source', ['sale', 'transaction'])
    ->whereNumber('id')
    ->name('reports.history.delete');
