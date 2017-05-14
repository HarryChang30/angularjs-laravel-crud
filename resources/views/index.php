<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Laravel and Angular CRUD System</title>

    <!-- CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <!-- Angular Material load from CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.1/angular-material.min.js"></script>
    <!-- Angular Application Scripts Load -->
    <script src="../angular/app.js"></script>
    <script src="../angular/controllers/SupplierController.js"></script>

  </head>
  <body>

      <div class="container" ng-app="getSupplier">
          <h2 style="padding-top:50px; padding-bottom:50px;">Supplier Application</h2>
          <div ng-controller="SupplierController">
              <table class="table table-striped">
                  <thead>
                      <tr>
                          <th>ID</th>
                          <th>Supplier Name</th>
                          <th>Supplier Email</th>
                          <th>Supplier Contact</th>
                          <th>Supplier Position</th>
                          <th>
                            <button id="btn-add" class="btn btn-success btn-xs" ng-click="toggle('add',0)">Add New Supplier</button>
                          </th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr ng-repeat="supplier in suppliers">
                          <td>{{ supplier.id }}</td>
                          <td>{{ supplier.supplierName }}</td>
                          <td>{{ supplier.supplierEmail }}</td>
                          <td>{{ supplier.supplierContact }}</td>
                          <td>{{ supplier.supplierPosition }}</td>
                          <td>
                            <button class="btn btn-warning btn-xs btn-detail" ng-click="toggle('edit' , supplier.id)" style="margin-left:30px;">
                                <span class="glyphicon glyphicon-edit"></span>
                            </button>
                            <button class="btn btn-danger btn-xs btn-delete" ng-click="deleteToggle(supplier.id)">
                               <span class="glyphicon glyphicon-trash"></span>
                            </button>
                          </td>

                      </tr>
                  </tbody>
              </table>


              <!-- Show Modal Form Add and Update -->
              <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">x</span>
                              </button>
                              <h4 class="modal-title" id="myModalLabel">{{ form_title }}</h4>
                          </div>
                          <div class="modal-body">
                              <form name="frmSupplier" class="form-horizontal" novalidate="">
                                  <div class="form-group">
                                      <label class="col-sm-3 control-label">Supplier Name</label>
                                      <div class="col-sm-9">
                                          <input type="text" class="form-control" id="supplierName" name="supplierName" placeholder="Supplier Name" value="{{ supplierName }}" ng-model="supplier.supplierName" required="true">
                                          <span ng-show="frmSupplier.supplierName.$invalid && frmSupplier.supplierName.$touched">Supplier Name field is required</span>
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      <label class="col-sm-3 control-label">Supplier Email</label>
                                      <div class="col-sm-9">
                                          <input type="email" class="form-control" id="supplierEmail" name="supplierEmail" placeholder="Supplier Email" value="{{ supplierEmail }}" ng-model="supplier.supplierEmail" required="true">
                                          <span ng-show="frmSupplier.supplierEmail.$invalid && frmSupplier.supplierEmail.$touched">Supplier Email field is required</span>
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      <label class="col-sm-3 control-label">Supplier Contact</label>
                                      <div class="col-sm-9">
                                          <input type="text" class="form-control" id="supplierContact" name="supplierContact" placeholder="Supplier Contact" value="{{ supplierContact }}" ng-model="supplier.supplierContact" required="true">
                                          <span ng-show="frmSupplier.supplierContact.$invalid && frmSupplier.supplierContact.$touched">Supplier Contact field is required</span>
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      <label class="col-sm-3 control-label">Supplier Position</label>
                                      <div class="col-sm-9">
                                          <input type="text" class="form-control" id="supplierPosition" name="supplierPosition" placeholder="Supplier Position" value="{{ supplierPosition }}" ng-model="supplier.supplierPosition" required="true">
                                          <span ng-show="frmSupplier.supplierPosition.$invalid && frmSupplier.supplierPosition.$touched">Supplier Position field is required</span>
                                      </div>
                                  </div>

                              </form>
                          </div>

                          <div class="modal-footer">
                              <button type="button" class="btn btn-primary" id="btn-save" ng-click="save(modalstate , id)" ng-disabled="frmSupplier.$invalid">Save Changes</button>
                          </div>

                      </div>
                  </div>
              </div>

              <!-- Show Confirm Delete Modal -->
              <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                              <div class="modal-header">
                                    <div class="alert alert-warning" style="margin-top:20px;">
                                        <strong>Delete</strong>
                                        <div style="margin-top:15px; margin-bottom:15px;">
                                            Are you sure to delete this record ?
                                        </div>
                                    </div>
                                    <div style="margin-top:10px;">
                                        <button type="button" class="btn btn-primary" id="btn-delete-yes" style="width:100px;" ng-click="saveDelete()">Yes</button>
                                        <button type="button" class="btn btn-danger" id="btn-delete-no" style="width:100px;" ng-click="closeDelete()">No</button>
                                    </div>
                              </div>

                        </div>
                    </div>
              </div>

              <!-- Success Modal -->
              <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                            <div class="alert alert-success" style="margin-top:20px;">
                                <strong>Success!</strong>
                                <div style="margin-top:15px; margin-bottom:15px;">
                                    {{ success_message }}
                                </div>
                            </div>
                        </div>
                      </div>
                  </div>
              </div>

              <!-- Error Modal -->
              <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                              <div class="alert alert-danger" style="margin-top:20px;">
                                  <strong>Failed!</strong>
                                  <div style="margin-top:15px; margin-bottom:15px;">
                                     {{ error_message }}
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>




      </div>

  </body>
</html>
