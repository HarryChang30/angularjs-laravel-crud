app.controller('SupplierController' , function($scope , $http , API_URL){

    $http.get(API_URL + "supplier").success(function(response){
        $scope.suppliers = response;
    });

    var modalstates = "";

    $scope.toggle = function(modalstate,id){

          modalstates = modalstate;

          if(modalstate === 'add'){
              $scope.form_title = "Add New Supplier";
              $scope.supplier = "";

          }else if(modalstate === 'edit'){
              $scope.form_title = "Supplier Detail";
              $scope.id = id;
              $http.get(API_URL + "supplier/" + id).success(function(response){
                  $scope.supplier = response;
              });
          }

          $('#myModal').modal('show');
    }

    $scope.deleteToggle = function(id){
       var url = API_URL + "supplier/" + id;
       $('#deleteModal').modal('show');

       $scope.closeDelete = function(){

          $('#deleteModal').modal('hide');

       }

       $scope.saveDelete = function(){

           $http({
               method: 'DELETE',
               url: url
           }).success(function(response){
               $('#deleteModal').modal('hide');
               $scope.success_message = "Delete Record Successfully";
               $http.get(API_URL + "supplier").success(function(response){
                   $scope.suppliers = response;
               });


               $('#successModal').modal('show');
               setTimeout(function(){
                   $('#successModal').modal('hide');
               } , 1000);

           }).error(function(response){
               $('#deleteModal').modal('hide');
               $scope.error_message = "Delete Record Failed!";
               $('#errorModal').modal('show');

               setTimeout(function(){
                  $('#errorModal').modal('hide');
               } , 1000);

           });

       }

    }



    $scope.save = function(modalstate,id){

        var url = API_URL + "supplier";
        if(modalstates === 'edit'){
            url += "/" + id;
        }

        $http({
           method: 'POST',
           url: url,
           data: $.param($scope.supplier),
           headers:{'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(response){


            if(modalstates === 'add'){
                $scope.success_message = "Add Record Successfully";
            }else if(modalstates === 'edit'){
                $scope.success_message = "Update Record Successfully";
            }


            $http.get(API_URL + "supplier").success(function(response){
                $scope.suppliers = response;
            });

            $('#myModal').modal('hide');
            $('#successModal').modal('show');


            setTimeout(function(){
                $('#successModal').modal('hide');
            } , 1000);


        }).error(function(response){

            $scope.error_message = "Save Record Failed!";

            $('#myModal').modal('hide');
            $('#errorModal').modal('show');

            setTimeout(function(){
                $('#errorModal').modal('hide');
            } , 1000);

        });
    }

    $scope.confirmDelete = function(id){
        var isConfirmDelete = confirm("Are you sure to delete this record?");

        if(isConfirmDelete){

            $http({
                method: 'DELETE',
                url: API_URL + 'supplier/' + id
            }).success(function(response){



            }).error(function(reponse){



            });

        }else{
            return false;
        }
    }

});
