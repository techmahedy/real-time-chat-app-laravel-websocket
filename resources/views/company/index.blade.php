@extends('layouts.app')

@section('content')

<a href="javascript:void(0)" class="btn btn-sm btn-outline-danger py-0" style="font-size: 0.8em;" id="createNewCompany">Add Company</a>

<table class="table table-hover data-table">
    <p id="success"></p>
    <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Address</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody id="bodyData">
        @foreach ($company as $element)
        <tr>
            <td>{{$element->id}}</td>
            <td>{{$element->name}}</td>
            <td>{{$element->address}}</td>
            <td>
                <a href="" class="btn btn-sm btn-outline-danger py-0" style="font-size: 0.8em;" id="editCompany" data-id="{{ $element->id }}" data-toggle="modal" data-target="#modal-id">
                  Edit
                </a> | 

                <a href="{{ route('company.destroy',$element->id) }}" class="btn btn-sm btn-outline-danger py-0" style="font-size: 0.8em;" id="deleteCompany" data-id="{{ $element->id }}">
                  Delete
               </a>

            </td>
        </tr>     
        @endforeach
   <tbody> 

        <div class="modal fade" id="modal-id">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="userCrudModal"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">

 <form id="companydata" method="POST">
     
    <input type="hidden" id="company_id" name="company_id" value="">

    <input type="text" id="name" name="name" value="">

    <input type="text" id="address" name="address" value="">

  </label><br>
  <input type="submit" value="Submit" id="submit" class="btn btn-sm btn-outline-danger py-0" style="font-size: 0.8em;">
</form>
                    </div>

                </div>
            </div>
        </div>

 </table>

@endsection

@section('insertcompany')

<script>

  $(document).ready(function () {
    
  $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  
  //Read data
//   window.onload = function(e){ 
//     var url = "{{URL::to('/')}}";
//     $.ajax({
//         url: url,
//         type: "POST",
//         data:{ 
            // _token:''
//         },
//         cache: false,
//         dataType: 'json',
//         success: function(dataResult){
          
//             var resultData = dataResult.data;
//             var bodyData = '';
//             var i=1;

//             $.each(resultData,function(index,row){

//                 bodyData+="<tr>"

//                 bodyData+="<td>"+ i++ +"</td><td>"+row.name+"</td><td>"+row.address+"</td>"
//                 +"<td><a class='btn btn-primary' href=''>Edit</a>" 
//                 +"<a class='btn btn-danger delete' style='margin-left:20px;'>Delete</a></td>";

//                 bodyData+="</tr>";
                
//             })
//             $("#bodyData").append(bodyData);
//           }
//         });
// }

   //Create Nem Company
  $('#createNewCompany').click(function (e) {
        e.preventDefault;
        $('#userCrudModal').html("Create company");
        $('#submit').val("Create company");
        $('#modal-id').modal('show');
        $('#company_id').val('');
        $('#companydata').trigger("reset");
       
    });


    //DeleteCompany

  $("#deleteCompany").click(function(e){

    if(!confirm("Do you really want to do this?")) {
       return false;
     }

    e.preventDefault();
    var id = $(this).data("id");
    // var id = $(this).attr('data-id');
    var url = e.target;
    console.log(url.href)

    $.ajax(
        {
          url: url.href,
          type: 'DELETE',
          data: {
            _token: "{{ csrf_token() }}",
                id: id
        },
        success: function (response){
          
            Swal.fire(
              'Remind!',
              'Company deleted successfully!',
              'success'
            )
        }
     });
      return false;
   });

  //EditCompanyInformation

  $('body').on('click', '#editCompany', function (event) {
     event.preventDefault();
     var id = $(this).data('id');
    
     $.get("{{ route('company.store') }}" +'/'+ id +'/edit', function (data) {
          
          $('#userCrudModal').html("Edit company");
          $('#submit').val("Edit company");
          $('#modal-id').modal('show');
          $('#company_id').val(data.data.id);
          $('#name').val(data.data.name);
          $('#address').val(data.data.address);
      })

    });

   $('body').on('click', '#submit', function (event) {
        
        var id = $("#company_id").val();
        var name = $("#name").val();
        var address = $("#address").val();
       
        $.ajax({
          url: "{{ route('company.store') }}",
          type: "POST",
          data: {
            id: id,
            name: name,
            address: address
          },
          dataType: 'json',

          success: function (data) {
              console.log('click again')
              $('#companydata').trigger("reset");
              $('#modal-id').modal('hide');

              Swal.fire({
                  position: 'top-end',
                  icon: 'success',
                  title: 'Company work has been updated',
                  showConfirmButton: false,
                  timer: 1500
              })
         
          },
          error: function (data) {
              console.log('Error:', data);
              $('#btn-save').html('Save Changes');
          }
      });
    });
    

});

</script>
@endsection