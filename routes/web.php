<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\GiftController;
use App\Http\Controllers\MailController;
// use QrCode;
use Illuminate\Support\Facades\App;

use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

///////////////////////admin/////////////////////////////

//dashboard
Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::get('/dashboard', [AdminController::class, 'showDashboard']);
Route::get('/logout', [AdminController::class, 'logout']);
Route::post('/admin-dashboard', [AdminController::class, 'loginDashboard']);

//Nhân viên

Route::get('/manage-employee', [EmployeeController::class, 'manageEmployee']);
Route::get('/add-employee', [EmployeeController::class, 'addEmployee']);
Route::post('/insert-employee', [EmployeeController::class, 'insertEmployee']);
Route::get('/delete-employee/{id}', [EmployeeController::class, 'deleteEmployee']);


//Lấy dữ liệu biểu đồ ajax
Route::get('/get-chart-data', [AdminController::class, 'getChartData']);
Route::get('/get-donut-data', [AdminController::class, 'getDonutData']);

//Quà tặng
Route::get('/manage-gift', [GiftController::class, 'manageGift']);
Route::get('/add-gift', [GiftController::class, 'addGift']);
Route::post('/insert-gift', [GiftController::class, 'insertGift']);
Route::get('/delete-gift/{gift_id}', [GiftController::class, 'deleteGift']);

//category
Route::get('/add-category', [CategoryProductController::class, 'addCategory']);
Route::get('/edit-category/{category_id}', [CategoryProductController::class, 'editCategory']);
Route::get('/delete-category/{category_id}', [CategoryProductController::class, 'deleteCategory']);
Route::post('/save-category', [CategoryProductController::class, 'saveCategory']);
Route::post('/update-category/{category_id}', [CategoryProductController::class, 'updateCategory']);
Route::get('/all-category', [CategoryProductController::class, 'allCategory']);

Route::post('/export-csv',[CategoryProductController::class, 'export_csv']);
Route::post('/import-csv',[CategoryProductController::class, 'import_csv']);

//blog category
Route::get('/add-blog-category', [BlogController::class, 'addBlogCategory']);
Route::get('/edit-blog-category/{blogcategory_id}', [BlogController::class, 'editBlogCategory']);
Route::get('/delete-blog-category/{blogcategory_id}', [BlogController::class, 'deleteBlogCategory']);
Route::post('/save-blog-category', [BlogController::class, 'saveBlogCategory']);
Route::post('/update-blog-category/{blogcategory_id}', [BlogController::class, 'updateBlogCategory']);
Route::get('/all-blog-category', [BlogController::class, 'allBlogCategory']);

Route::get('/check-blog', [BlogController::class, 'checkBlog']);

Route::post('/blogcategory-export-csv',[BlogController::class, 'export_csvBlogCategory']);
Route::post('/blogcategory-import-csv',[BlogController::class, 'import_csvBlogCategory']);

//product
Route::get('/add-product', [ProductController::class, 'addProduct']);
Route::get('/edit-product/{product_id}', [ProductController::class, 'editProduct']);
Route::get('/delete-product/{product_id}', [ProductController::class, 'deleteProduct']);
Route::post('/save-product', [ProductController::class, 'saveProduct']);
Route::post('/update-product/{product_id}', [ProductController::class, 'updateProduct']);
Route::get('/all-product', [ProductController::class, 'allProduct']);

Route::post('/export-product-csv',[ProductController::class, 'export_csv']);
Route::post('/import-product-csv',[ProductController::class, 'import_csv']);

//comment
Route::post('/load-comment', [ProductController::class, 'loadComment']);
Route::post('/send-comment', [ProductController::class, 'sendComment']);

//rating
Route::post('/rating', [ProductController::class, 'rating']);

//comment
Route::get('/manage-comment', [CommentController::class, 'manageComment']);
Route::get('/delete-comment/{id}', [CommentController::class, 'deleteComment']);


//order
Route::get('/manage-order', [OrderController::class, 'manageOrder']);
Route::get('/handle-order', [OrderController::class, 'handleOrder']);
Route::get('/view-order/{order_id}', [OrderController::class, 'viewOrder']);
Route::get('/delete-order/{order_id}',[OrderController::class, 'deleteOrder']);
Route::get('/print-order/{order_id}',[OrderController::class, 'printOrder']);
Route::post('/shipping-order',[OrderController::class, 'shippingOrder']);
Route::get('/cancel-order-admin/{order_id}',[OrderController::class, 'cancelOrderAdmin']);

//coupon
Route::get('/manage-coupon', [CouponController::class, 'manageCoupon']);
Route::get('/insert-coupon',[CouponController::class, 'insertCoupon']);
Route::get('/delete-coupon/{coupon_id}',[CouponController::class, 'deleteCoupon']);
Route::post('/add-coupon',[CouponController::class, 'addCoupon']);

//user
Route::get('/manage-user', [UserController::class, 'manageUser']);
Route::get('/delete-user/{user_id}', [UserController::class, 'deleteUser']);
Route::get('/add-user', [UserController::class, 'addUser']);
Route::post('/insert-user', [UserController::class, 'insertUser']);

//banner
Route::get('/manage-banner', [BannerController::class, 'manageBanner']);
Route::get('/add-banner', [BannerController::class, 'addBanner']);
Route::post('/insert-banner', [BannerController::class, 'insertBanner']);
Route::get('/unactive-banner/{banner_id}', [BannerController::class, 'unactiveBanner']);
Route::get('/active-banner/{banner_id}', [BannerController::class, 'activeBanner']);
Route::get('/delete-banner/{banner_id}', [BannerController::class, 'deleteBanner']);

//blogs
Route::get('/manage-blog', [BlogController::class, 'manageBlog']);
Route::get('/insert-blog', [BlogController::class, 'insertBlog']);
Route::post('/add-blog', [BlogController::class, 'addBlog']);
Route::get('/delete-blog/{blog_id}', [BlogController::class, 'deleteBlog']);
Route::get('/edit-blog/{blog_id}', [BlogController::class, 'editBlog']);
Route::post('/update-blog/{blog_id}', [BlogController::class, 'updateBlog']);

Route::get('/view-blog/{blog_id}', [BlogController::class, 'viewBlog']);
Route::get('/pass-blog/{blog_id}', [BlogController::class, 'passBlog']);

//feedback
Route::get('/manage-feedback', [FeedbackController::class, 'manageFeedback']);
Route::get('/handle-feedback/{feedback_id}', [FeedbackController::class, 'handleFeedback']);


////////////////////////user/////////////////////////////

//index
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::post('/tim-kiem', [HomeController::class, 'search']);


Route::post('/send-mail', [MailController::class, 'sendMail']);
Route::get('/send-coupon', [MailController::class, 'sendCoupon']);

//Thông tin
Route::get('/profile', [HomeController::class, 'profile']);
Route::post('/change-profile', [HomeController::class, 'changeProfile']);
Route::post('/change-shipping', [HomeController::class, 'changeShipping']);
Route::get('/change-password', [HomeController::class, 'changePassword']);
Route::post('/change-pass', [HomeController::class, 'changePass']);

//Đổi quà
Route::get('/exchange-gift', [GiftController::class, 'exchangeGift']);
Route::get('/exchange-gift/{point}', [GiftController::class, 'exchange']);
Route::get('/get-point', [GiftController::class, 'getPoint']);
Route::get('/show-gift', [GiftController::class, 'showGift']);


//Đơn hàng
Route::get('/cancel-order/{order_id}', [HomeController::class, 'cancelOrder']);
Route::get('/confirm-order/{order_id}', [HomeController::class, 'confirmOrder']);
Route::get('/view-order-user/{order_id}', [HomeController::class, 'viewOrderUser']);
Route::get('/manage-order-user', [HomeController::class, 'manageOrderUser']);


//Feedback
Route::post('/send-feedback', [FeedbackController::class, 'sendFeedback']);

//Đăng nhập, đăng ký
Route::post('/login',[HomeController::class, 'login']);
Route::get('/login-user',[HomeController::class, 'loginUser']);
Route::get('/logout-user',[HomeController::class, 'logoutUser']);
Route::post('/add-user',[HomeController::class, 'addUser']);

//Yêu thích
Route::get('/add-to-wishlist/{product_id}',[HomeController::class, 'addWishlist'])->name('add-to-wishlist');
Route::get('/show-wishlist',[HomeController::class, 'showWishlist']);
Route::get('/remove-wishlist/{product_id}',[HomeController::class, 'removeWishlist']);

//product
Route::get('/danh-muc/{category_id}', [CategoryProductController::class, 'showCategoryHome']);
Route::get('/chi-tiet/{product_id}', [ProductController::class, 'detailProduct']);

//Cửa hàng
Route::get('/market', [HomeController::class, 'market']);

//Blogs 
Route::get('/blogs', [BlogController::class, 'blogs']);
Route::get('/blog/{blog_id}', [BlogController::class, 'blogdetail']);
Route::post('/tim-kiem-blog', [BlogController::class, 'searchBlog']);
Route::get('/danh-muc-blog/{cateblog_id}', [BlogController::class, 'categoryBlog']);
Route::get('/share-blog', [BlogController::class, 'shareBlog']);


//QRCode
Route::get('/generate-qrcode/{product_id}', [QrCodeController::class, 'generateQrcode']);

//Liên hệ
Route::get('/contact', [HomeController::class, 'contact']);

//Giỏ hàng
Route::post('/add-carts',[CartController::class, 'addCarts']);
Route::get('/show-cart',[CartController::class, 'showCart']);
Route::get('/reload-total',[CartController::class, 'reloadTotal']);
Route::get('/add-to-cart/{product_id}',[CartController::class, 'addCart'])->name('add-to-cart');
Route::get('/delete-cart/{product_id}',[CartController::class, 'deleteCart']);
Route::post('/save-cart-all',[CartController::class, 'saveCartAll']);

//Đặt hàng
Route::post('/save-checkout-user',[CheckoutController::class, 'saveCheckout']);
Route::get('/payment',[CheckoutController::class, 'payment']);
Route::get('/checkout',[CheckoutController::class, 'checkout']);

//Thanh toán
Route::post('/vnpay',[PaymentController::class, 'vnpay']);
Route::post('/onepay',[PaymentController::class, 'onepay']);
Route::post('/momo',[PaymentController::class, 'momo']);
Route::post('/cash',[PaymentController::class, 'cash']);
Route::post('/paypal',[PaymentController::class, 'paypal']);

//Mã giảm giá
Route::post('/check-coupon',[CouponController::class, 'checkCoupon']);
Route::get('/unset-coupon',[CouponController::class, 'unsetCoupon']);
Route::get('/load_total',[CouponController::class, 'loadTotal']);