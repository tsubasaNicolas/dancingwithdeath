@extends('layouts.app')

@section('template_title')
    Appointment
@endsection

@section('content')
    <div class="container-fluid">
        <h2 class="text-center text-warning">Select the day you want to dance with death</h2>
        <div id="agenda">

        </div>
     
    </div>

<!-- Modal -->
<div class="modal fade" id="appointment" style="height:100%;"
tabindex="-1"
 role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">

<div class="modal-dialog" role="document">
     
    <div class="modal-content" id="modal-content"  style="background-color:#34495E;">
         


         <div class="modal-header">
                <h5 class="modal-title text-warning">Appointment with Death</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
        </div>


            <div class="modal-body">

            <form method="POST" action="{{ route('appointments.store') }}"  
                        role="form" enctype="multipart/form-data">
                            @csrf

          

                   <div class="form-group">
                     <label for="name" class="text-primary">Name</label>
                     <input type="text" class="form-control" autofocus required name="name" id="name" aria-describedby="helpId" placeholder="">
                    
                     
                   </div>

                   <div class="form-group">
                     <label for="email" class="text-primary">Email</label>
                     <input type="text" class="form-control" required name="email" id="email" aria-describedby="helpId" placeholder="">
                    
                   </div>

                   <div class="form-group">
                     <label for="startTime" class="text-primary">Start</label>
                     <input type="text" class="form-control"  value="" readonly
                       name="startTime" id="startTime" aria-describedby="helpId" placeholder="">
                   
                   </div>

                   <div class="form-group" >
                     <label for="endTime" class="text-primary">End</label>
                     <input type="text" class="form-control"  value="" readonly
                       name="endTime" id="endTime" aria-describedby="helpId" placeholder="">
                     
                   </div>

                

                   <button type="submit" class="btn btn-primary">Save</button>

              </form>

            </div>
           


                <button type="button" class="btn btn-danger m-2 mt-3" data-dismiss="modal">Close</button>
            </div>  

        </div>

    </div>

</div>



<!-- modal-eliminar -->



<!-- Modal -->
<div class="modal fade" id="eventModal" 
tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document" >
        <div class="modal-content" style="background-color:#34495E;">

        <form action="{{ route('appointments.destroy', 1 ) }}" method="POST">

        @csrf
        @method('DELETE')

            <div class="modal-header">
                <h5 class="modal-title h1 text-warning" id="name0"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>

            <div class="modal-body">
                <div class="form-group">

                <input type="hidden" name="appointmentId"  id="appointmentId">
                  
               
                    <p class="text-primary">You have an appointment to dancing with Death</p>
                    <span class="h5 text-primary" id="date"></span> <span class="text-primary"> AT</span> <span class="h5 text-primary" id="hour"></span>
                </div>
             
            </div>
            <div class="text-center font-italic text-danger">Memento Mori</div>


            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">forget</button>
                <button type="submit" class="btn btn-danger">Delete</button>
            </div>

            </form>

        </div>
    </div>
</div>

</div>


@endsection
