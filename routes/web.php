<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\UserController; 
use App\Http\Controllers\Backend\PropertyTypeContorller;
use App\Http\Controllers\Backend\AmenitieContorller;
use App\Http\Controllers\Backend\PropertyController;
use App\Http\Middleware\RedirectIfAuthenticated;

// Route::get('/', function () {
//     return view('welcome');
// });
//user forntend all route
Route::get('/', [UserController::class, 'Index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/user/profile', [UserController::class, 'UserProfile'])->name('user.profile');
    Route::post('/user/profile/store', [UserController::class, 'UserProfileStore'])->name('user.profile.store');
    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');
    Route::get('/user/change/password', [UserController::class, 'UserChangePassword'])->name('user.change.password');
    Route::post('/user/password/update', [UserController::class, 'UserPasswordUpdate'])->name('user.password.update');
   
});

require __DIR__.'/auth.php';

// admin dashboard route
Route::middleware(['auth', 'role:admin'])->group(function () {
    // admin.user.index
    Route::get('/admin/user/index',[AdminController::class,'UserIndex'] )->name('admin.user.index');
    // admin.user.status.change
    Route::post('/admin/user/status/change/{id}',[AdminController::class,'UserStatusChange'] )->name('admin.user.status.change');
    //add.agent
    Route::get('/admin/add/agent', [AdminController::class, 'AddAgent'])->name('add.agent');
    //store.agent
    Route::post('/admin/store/agent', [AdminController::class, 'StoreAgent'])->name('store.agent');
    // edit.agent
    Route::get('/admin/edit/agent/{id}', [AdminController::class, 'EditAgent'])->name('edit.agent'); 
    // update.agent
    Route::post('/admin/update/agent/{id}', [AdminController::class, 'UpdateAgent'])->name('update.agent');
    // delete.agent
    Route::get('/admin/delete/agent/{id}', [AdminController::class, 'DeleteAgent'])->name('agent.delete');

    // url ajax route
    // /changeStatus
    Route::get('/changeStatus', [AdminController::class, 'changeStatus']);

    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    //admin.profile
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    //admin.change.password
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/update/change/password', [AdminController::class, 'AdminUpdateChangePassword'])->name('update.change.password');
    
});

// admin dashboard route PropertyTypeContorller
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::controller(PropertyTypeContorller::class)->group(function () {
        Route::get('/admin/property-type/index', 'PropertyTypeIndex')->name('admin.property-type.index');
        Route::get('/admin/property-type/add', 'PropertyTypeAdd')->name('admin.property-type.add');
        Route::post('/admin/property-type/store', 'PropertyTypeStore')->name('admin.property-type.store');
        Route::get('/admin/property-type/edit/{id}', 'PropertyTypeEdit')->name('admin.property-type.edit');
        Route::post('/admin/property-type/update/', 'PropertyTypeUpdate')->name('admin.property-type.update');
        Route::get('/admin/property-type/delete/{id}', 'PropertyTypeDelete')->name('admin.property-type.delete');
        
        
    });

    //Amenity
    Route::controller(AmenitieContorller::class)->group(function () {
        Route::get('/admin/amenity/index', 'AmenityIndex')->name('admin.amenitie-type.index');
        Route::get('/admin/amenity/add', 'AmenityAdd')->name('admin.amenitie-type.add');
        Route::post('/admin/amenity/store', 'AmenityStore')->name('admin.amenitie-type.store');
        Route::get('/admin/amenity/edit/{id}', 'AmenityEdit')->name('admin.amenitie-type.edit');
        Route::post('/admin/amenity/update/', 'AmenityUpdate')->name('admin.amenitie-type.update');
        Route::get('/admin/amenity/delete/{id}', 'AmenityDelete')->name('admin.amenitie-type.delete');

    });
    //Property
    Route::controller(PropertyController::class)->group(function () {
        Route::get('/admin/property/index', 'PropertyIndex')->name('admin.property.index');
        Route::get('/admin/property/add', 'PropertyAdd')->name('admin.property.add');
        Route::post('/admin/property/store', 'PropertyStore')->name('admin.property.store');
        Route::get('/admin/property/edit/{id}', 'PropertyEdit')->name('admin.property.edit');
        Route::post('/admin/property/update/', 'PropertyUpdate')->name('admin.property.update');
        Route::get('/admin/property/delete/{id}', 'PropertyDelete')->name('admin.property.delete');
        //admin.property.view
        Route::get('/admin/property/view/{id}', 'PropertyView')->name('admin.property.view');

        //admin.property.update.thambnail
        Route::post('/admin/property/update/thambnail/', 'PropertyThambnailUpdate')->name('admin.property.update.thambnail');
        // admin.property.update.multiimage
        Route::post('/admin/property/update/multiimage/', 'PropertyMultiImageUpdate')->name('admin.property.update.multiimage');
        // admin.property.delete.multiimage
        Route::get('/admin/property/delete/multiimage/{id}', 'PropertyMultiImageDelete')->name('admin.property.delete.multiimage');
        // admin.property.update.multiimage.new.store
        Route::post('/admin/property/update/multiimage/new/store/', 'PropertyMultiImageNewStore')->name('admin.property.update.multiimage.new.store');
        //admin.property.update.facility
        Route::post('/admin/property/update/facility/', 'PropertyFacilityUpdate')->name('admin.property.update.facility');
        //property.inactive
        Route::post('/admin/property/inactive/{id}', 'PropertyInactive')->name('admin.property.inactive');
        //property.active
        Route::post('/admin/property/active/{id}', 'PropertyActive')->name('admin.property.active');
    });
});


// agent dashboard route
Route::middleware(['auth', 'role:agent'])->group(function () {
    Route::controller(AgentController::class)->group(function () {
        Route::get('/agent/dashboard', 'AgentDashboard')->name('agent.dashboard');
        Route::get('/agent/logout', 'AgentLogout')->name('agent.logout');
        Route::get('/agent/change/password', 'AgentChangePassword')->name('agent.change.password');
        Route::post('/agent/password/update', 'AgentPasswordUpdate')->name('agent.password.update');
        Route::get('/agent/profile', 'AgentProfile')->name('agent.profile');
        Route::post('/agent/profile/store', 'AgentProfileStore')->name('agent.profile.store');

    });
    
});

// admin login route
Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login')->middleware(RedirectIfAuthenticated::class); 
//agent login route
Route::get('/agent/login', [AgentController::class, 'AgentLogin'])->name('agent.login')->middleware(RedirectIfAuthenticated::class);
// agent.register
Route::post('/agent/register', [AgentController::class, 'AgentRegister'])->name('agent.register');