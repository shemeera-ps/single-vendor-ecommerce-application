<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AddressTagController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\AttributevalueController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductAttributeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductTagController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\ProductvariantController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuantityController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\WishlistController;
use Modules\Ynotz\EasyAdmin\Services\RouteHelper;
use Modules\Ynotz\AppSettings\Http\Controllers\AppSettingsController;
use App\Models\Category;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    RouteHelper::getEasyRoutes(
        modelName: 'AppSetting',
        controller: AppSettingsController::class
    );

    Route::get('/roles-permissions', [RoleController::class, 'rolesPermissions'])->name('roles.permissions');
    Route::post('/roles/permission-update', [RoleController::class, 'permissionUpdate'])->name('roles.update_permissions');
});
RouteHelper::getEasyRoutes(
    modelName:'Category',
    controller:CategoryController::class
);
RouteHelper::getEasyRoutes(
    modelName:'Product',
    controller:ProductController::class
);
RouteHelper::getEasyRoutes(
    modelName:'Wishlist',
    controller:WishlistController::class
);
RouteHelper::getEasyRoutes(
    modelName:'Quantity',
    controller:QuantityController::class
);
RouteHelper::getEasyRoutes(
    modelName:'Tag',
    controller:TagController::class
);
RouteHelper::getEasyRoutes(
    modelName:'ProductTag',
    controller:ProductTagController::class
);
RouteHelper::getEasyRoutes(
    modelName:'Address',
    controller:AddressController::class
);
RouteHelper::getEasyRoutes(
    modelName:'AddressTag',
    controller:AddressTagController::class
);
RouteHelper::getEasyRoutes(
    modelName:'Size',
    controller:SizeController::class
);
RouteHelper::getEasyRoutes(
    modelName:'Attribute',
    controller:AttributeController::class
);
RouteHelper::getEasyRoutes(
    modelName:'ProductType',
    controller:ProductTypeController::class
);

RouteHelper::getEasyRoutes(
    modelName:'Productvariant',
    controller:ProductvariantController::class
);



Route::get('/index',[ProductController::class,'productIndex'])->name('productIndex');
Route::get('/wishlist/items',[WishlistController::class,'wishlistIndex'])->name('wishlistIndex');

Route::post('/addToCart',[CartController::class,'addToCart'])->name('addToCart');

Route::post('/plusCart/{product}',[CartController::class,'plusCart'])->name('plusCart');
Route::post('/minusCart/{product}',[CartController::class,'minusCart'])->name('minusCart');
Route::post('/deleteCart/{product}',[CartController::class,'deleteCart'])->name('deleteCart');
Route::post('/addToWishlist',[WishlistController::class,'addToWishlist'])->name('addToWishlist');
Route::post('/deleteWishlist/{product}',[WishlistController::class,'removeWishlist'])->name('removeWishlist');
Route::get('/cart/items',[CartController::class,'cartIndex'])->name('cartIndex');


Route::post('/checkout{cart}',[OrderController::class,'checkout'])->name('checkout');

Route::get('/orders',[OrderController::class,'orderIndex'])->name('orderIndex');

Route::get('/payments',[OrderController::class,'payments'])->name('payments');

Route::get('/showProducts/{category}',[CategoryController::class,'showProducts'])->name('showProducts');

Route::get('/productDetail/{product}',[ProductController::class,'productShow'])->name('productShow');

Route::post('/search',[ProductController::class,'search'])->name('search');

Route::post('/setAddress',[AddressController::class,'setAddress'])->name('setAddress');

require __DIR__.'/auth.php';



// Route::get('/checkout', 'StripePaymentController@checkout');
// Route::post('/checkout', 'StripePaymentController@afterpayment')->name('stripe.payment');
