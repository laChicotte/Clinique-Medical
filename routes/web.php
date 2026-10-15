<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\PharmacyController;
use App\Http\Controllers\LaboratoryController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\BlocController;
use App\Http\Controllers\PayrollController;

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

// Route::get('/', function () {
//     return view('welcome');
// }); 





Route::group(['middleware' => 'auth'], function() {
    Route::get('/admin-dashboard', [AdminController::class, 'adminDashboardPage'])->name('dashboard');
    Route::get('/admin-profil-system', [AdminController::class, 'adminMyProfilePage']);
    Route::get('/admin-logOut', [AdminController::class, 'adminLogOutPage'])->name('logoutAdmin');
    Route::get('users/add-user', [AdminController::class, 'addUserPage'])->name('addUser');
    Route::get('users/manage-user', [AdminController::class, 'manageUserPage'])->name('manageUser');
    Route::post('users/saveUser/{id}', [AdminController::class, 'saveUser'])->name('user.store');
    Route::delete('user/delete/{id}', [AdminController::class, 'deleteUser'])->name('user.delete');
    Route::post('user/change/{id}', [AdminController::class, 'changePasswordUser'])->name('user.cpwd');
    
    // Patient Route
    Route::get('patients/add-patient', [PatientController::class, 'addPatientPage']);
    Route::get('patients/manage-patient', [PatientController::class, 'managePatientPage']);
    Route::get('patients/all-patient', [PatientController::class, 'allPatientPage'])->name('patients.all-patient');
    Route::get('patients/transfer-patient', [PatientController::class, 'transferPatientPage']);
    Route::get('patients/form-transfer-patient/{id}', [PatientController::class, 'formTransferPatientPage']);
    Route::get('patients/free-patient', [PatientController::class, 'freePatientPage']);
    Route::get('patient/details-patient/{id}', [PatientController::class, 'detailsPatientPage']);
    Route::get('patient/edit-patient/{id}', [PatientController::class, 'editPatientPage']);

    Route::delete('patient/delete-patient/{id}', [PatientController::class, 'deletePatient']);
    Route::post('patient/savePatient', [PatientController::class, 'savePatient']);
    Route::put('patient/update-patient/{id}', [PatientController::class, 'updatePatient']);
    Route::put('patient/save-transfer/{id}', [PatientController::class, 'saveTransferPatient']);

    // Employee Route
    Route::get('employees/add-employee', [EmployeeController::class, 'addEmployeePage']);
    Route::get('employees/edit-employee/{id}', [EmployeeController::class, 'editEmployeePage']);
    Route::get('employees/manage-employee', [EmployeeController::class, 'manageEmployeePage']);
    Route::get('employees/all-employee', [EmployeeController::class, 'allEmployeePage'])->name('employees.all-employee');
    Route::get('employees/transfer-employee/{id}', [EmployeeController::class, 'transferEmployeePage']);
    Route::get('employees/depart-employee', [EmployeeController::class, 'departEmployeePage']);
    Route::get('employees/details-employee/{id}', [EmployeeController::class, 'detailsEmployeePage']);

    Route::post('employee/saveEmployee', [EmployeeController::class, 'saveEmployee']);
    Route::put('employee/update-employee/{id}', [EmployeeController::class, 'updateEmployee']);
    Route::delete('employees/delete-employee/{id}', [EmployeeController::class, 'deleteEmployee']);
    Route::put('employees/valide-departement/{id}', [EmployeeController::class, 'valideDepartementEmployee']);


    // les ordonnances Route
    Route::get('prescriptions/add-prescription', [PharmacyController::class, 'addPrescriptionPage']);
    Route::get('prescriptions/manage-prescription', [PharmacyController::class, 'managePrescriptionPage']);
    Route::get('prescriptions/all-prescription', [PharmacyController::class, 'allPrescriptionPage']);

    Route::get('prescription/add/{id}', [PharmacyController::class, 'addDetailsPrescriptionPage'])->name('prescription.detail');
    Route::post('/save-prescription', [PharmacyController::class, 'savePrescription'])->name('prescription.save');
    Route::get('/prescription/{id}', [PharmacyController::class, 'showPrescription'])->name('prescription.view');
    Route::get('/prescription/{id}/edit', [PharmacyController::class, 'editPrescriptionPage'])->name('prescription.edit');
    Route::put('/prescription/{id}', [PharmacyController::class, 'updatePrescription'])->name('prescription.update');
    Route::delete('/prescription/{id}', [PharmacyController::class, 'deletePrescription'])->name('prescription.delete');



    // Produits Route
    Route::get('products/add-product', [PharmacyController::class, 'addProductPage']);
    Route::get('products/manage-product', [PharmacyController::class, 'manageProductPage']);
    Route::get('products/all-product', [PharmacyController::class, 'allProductPage']);
    Route::get('products/{id}', [PharmacyController::class, 'showProductPage'])->name('product.show');

    Route::post('product/save', [PharmacyController::class, 'saveProduct'])->name('product.save');
    Route::delete('product/delete/{id}', [PharmacyController::class, 'deleteProduct'])->name('product.delete');
    Route::get('product/edit/{id}', [PharmacyController::class, 'editProductPage'])->name('product.edit');
    Route::put('product/update/{id}', [PharmacyController::class, 'updateProduct'])->name('product.update');


    // Catégoies des produits Route
    Route::get('catProducts/add-catProduct', [PharmacyController::class, 'addCatProductPage']);
    Route::get('catProducts/manage-catProduct', [PharmacyController::class, 'manageCatProductPage'])->name('category.manage');
    Route::get('catProducts/all-catProduct', [PharmacyController::class, 'allCatProductPage']);
    Route::post('category/store', [PharmacyController::class, 'saveCategory'])->name('category.store');
    Route::delete('category/delete/{id}', [PharmacyController::class, 'deleteCategory'])->name('category.delete');
    Route::get('category/edit/{id}', [PharmacyController::class, 'editCatProductPage'])->name('category.edit');
    Route::get('categories/{category}', [PharmacyController::class, 'showCategory'])->name('category.show');
    Route::put('category/update/{id}', [PharmacyController::class, 'updateCategory'])->name('category.update');




    // Comptabilité Route
    Route::get('accounting/add-accountPay', [AdminController::class, 'addAccountPayPage']);
    Route::get('accounting/manage-accountPay', [AdminController::class, 'manageAccountPayPage']);

    Route::get('accounting/add-accountRecev', [AdminController::class, 'addAccountRecevPage']);
    Route::get('accounting/manage-accountRecev', [AdminController::class, 'manageAccountRecevPage']);

    // Inventaires Route
    Route::get('inventory/inventory-product', [InventoryController::class, 'inventoryProductPage']);
    Route::get('inventory/inventory-asset', [InventoryController::class, 'inventoryAssetPage']);

    // Rapports Route
    Route::get('record/record-inPatient', [ReportController::class, 'recordInPatientPage']);
    Route::get('record/record-outPatient', [ReportController::class, 'recordOutPatientPage']);
    Route::get('record/record-product', [ReportController::class, 'recordProductPage']);
    Route::get('record/record-account', [ReportController::class, 'recordAccountPage']);
    Route::get('record/record-employee', [ReportController::class, 'recordEmployeePage']);
    Route::get('record/record-medical', [ReportController::class, 'recordMedicalPage']);

    Route::get('record/detail-patient/{id}', [ReportController::class, 'viewRecordPatientProfilePage'])->name('record.patient.detail');
    Route::get('record/detail-employee/{id}', [ReportController::class, 'viewRecordEmployeeProfilePage'])->name('record.employee.detail');

    // Records Routes
    Route::get('record/add-record', [AdminController::class, 'addRecordPage']);
    Route::get('record/manage-record', [AdminController::class, 'manageRecordPage']);


    // Laboratoires Routes
    Route::get('laboratory/manage-laboratory-equipement', [LaboratoryController::class, 'manageLabEquipementPage'])->name('manage.equipement');
    Route::get('laboratory/add-laboratory-equipement', [LaboratoryController::class, 'addLabEquipementPage']);
    Route::get('laboratory/lab-patient-vital', [LaboratoryController::class, 'labPatientVitalPage']);
    Route::get('laboratory/lab-patient-test', [LaboratoryController::class, 'labPatientTestPage']);
    Route::get('laboratory/lab-patient-result', [LaboratoryController::class, 'labPatientResultPage']);
    Route::get('laboratory/lab-employee-vital', [LaboratoryController::class, 'labEmployeeVitalPage']);
    Route::get('laboratory/lab-report', [LaboratoryController::class, 'labReportPage']);

    Route::post('add/equipement/lab', [LaboratoryController::class, 'saveEquipement'])->name('equipement.save.lab');
    Route::delete('equipement/delete/{id}', [LaboratoryController::class, 'deleteEquipement'])->name('equipement.delete');
    Route::put('update/equipement/lab/{id}', [LaboratoryController::class, 'updateEquipement'])->name('equipement.update.lab');
    Route::get('laboratory-equipement/{id}', [LaboratoryController::class, 'labDetailsEquipementPage'])->name('equipement.detail');
    Route::get('laboratory-equipement/edit/{id}', [LaboratoryController::class, 'editLabEquipementPage'])->name('equipement.edit');

    Route::put('/laboratory-result/{id}', [LaboratoryController::class, 'resultLaboratory'])->name('laboratory.result');
    Route::get('laboratory-add-vital-employee/{id}', [LaboratoryController::class, 'addLabEmployeeVitalPage'])->name('add_employee_vitals');
    Route::get('laboratory-add-vital-patient/{id}', [LaboratoryController::class, 'addLabPatientVitalPage'])->name('add_patient_vitals');
    Route::post('/save-laboratory', [LaboratoryController::class, 'saveLaboratory'])->name('laboratory.save');
    Route::get('laboratory/add/{id}', [LaboratoryController::class, 'labDetailsPatientTestPage'])->name('laboratory.detail');
    Route::get('laboratory/record/{id}', [LaboratoryController::class, 'labRecordPage'])->name('laboratory.record');
    Route::get('laboratory/result/{id}', [LaboratoryController::class, 'labDetailsPatientResultPage'])->name('laboratory.result');
    Route::post('/save-employeevitals', [LaboratoryController::class, 'saveEmployeeVital'])->name('save.Employee.Vital');
    Route::post('/save-patient-vitals', [LaboratoryController::class, 'savePatientVital'])->name('save.Patient.Vital');

    // Bloc operatoire Routes
    Route::post('add/equipement/bloc', [BlocController::class, 'saveEquipement'])->name('equipement.save.bloc');
    Route::get('bloc/add-patient', [BlocController::class, 'addBlocPatientPage']);
    Route::get('bloc/add-patient-form/{id}', [BlocController::class, 'addBlocPatientFormPage'])->name('bloc.addPatient.form');
    Route::get('bloc/add-equipement', [BlocController::class, 'addBlocEquipementPage']);
    Route::get('bloc/manage-patient', [BlocController::class, 'manageBlocPatientPage'])->name('manage.patient.bloc');
    Route::get('bloc/manage-equipement', [BlocController::class, 'manageBlocEquipementPage'])->name('manage.equipement.bloc');
    Route::get('bloc/bloc-record', [BlocController::class, 'blocRecordPage']);


    Route::get('bloc/edit-patient/{id}', [BlocController::class, 'editBlocPatientPage'])->name('surgery.edit');
    Route::get('bloc/detail-patient/{id}', [BlocController::class, 'viewDetailBlocPatientPage'])->name('surgery.details');
    Route::put('update/surgery/{id}', [BlocController::class, 'updateSurgery'])->name('surgery.update');
    Route::delete('delete/surgery/{id}', [BlocController::class, 'deleteSurgery'])->name('surgery.delete');

    Route::post('/surgeries/store', [BlocController::class, 'saveSurgery'])->name('surgeries.store');

    // Fournisseurs Routes
    Route::get('vendor/add-vendor', [VendorController::class, 'addVendorPage']);
    Route::get('vendor/edit-vendor/{id}', [VendorController::class, 'editVendorPage']);
    Route::get('vendor/details-vendor/{id}', [VendorController::class, 'detailVendorPage']);

    Route::get('vendor/manage-vendor', [VendorController::class, 'manageVendorPage'])->name('vendor.manage-vendor');

    Route::post('vendor/saveVendor', [VendorController::class, 'saveVendor']);
    Route::put('vendor/update-vendor/{id}', [VendorController::class, 'updateVendor']);
    Route::delete('vendor/delete-vendor/{id}', [VendorController::class, 'deleteVendor']);

    // Salaires Routes
    Route::get('payroll/add-payroll', [PayrollController::class, 'addPayrollPage']);
    Route::get('payroll/add-payroll-Form/{id}', [PayrollController::class, 'addPayrollFormPage'])->name('add.payroll.form');
    Route::get('payroll/print/{id}', [PayrollController::class, 'printPayrollPage'])->name('print.payroll');
    Route::post('/payroll/store', [PayrollController::class, 'savePayroll'])->name('payroll.store');

    Route::get('payroll/manage-payroll', [PayrollController::class, 'managePayrollPage']);

    // Mots de passe Route
    Route::get('password/manage-password-reset', [AdminController::class, 'managePasswordResetPage']);


});

// Middleware pour rediriger vers loginAdmin si non connecté
Route::get('/admin-login', [AdminController::class, 'adminLoginPage'])->name('loginAdmin');
Route::get('/', [AdminController::class, 'viewHomePage']);
Route::post('/admin-login-post', [AdminController::class, 'adminLoginPost'])->name('login.adminPost');
Route::get('/doctor-login', [AdminController::class, 'doctorLoginPage']);
