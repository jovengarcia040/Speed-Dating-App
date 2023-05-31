@extends('../layouts/app')



@section('content')

<section class="bg-gray-50 dark:bg-gray-900">

  <div class="h-screen flex flex-col px-6 py-8">

      <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white mb-6 flex">

        Event's list
        <button type="button" id="back" class="ml-auto text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                                                >Back</button>
      </h1>

      <div class="w-full bg-white rounded-lg shadow dark:border xl:p-0 dark:bg-gray-800 dark:border-gray-700">

          <div class="p-6 space-y-2 md:space-y-3 sm:p-8 flex justify-center p">

              <ul class=" max-w-lg w-96 p-1 list-none">

                @foreach($events as $event)

                <li class="justify-center flex items-center  mb-2 event-list">

                    <a class="align mr-auto cursor-pointer hover:text-red-700"  href="{{url('/')}}/admin/event/{{$event->id}}">{{$event->name}} {{$event->date}} </a><span id="{{$event->id}}" class="trash block cursor-pointer text-sm px-3 py-2.5"><i class="fa fa-trash-o"></i></span>

                </li>

                @endforeach

              </ul>

          </div>

      </div>

  </div>

</section>
<script>
  $(document).on('click','#back', function(){
    location.href = `${base_url}/admin/`
  })
  $(document).on("click",".trash",function(){
    $.ajax({
          url: `${base_url}/admin/event/delete`,
          type: 'POST',
          data: {
            _token: '{{ csrf_token() }}',
            id:this.id,
          },
          success:function(res){
            toastr.success('Successfully removed.');
            setTimeout(() => {
              location.reload();
            }, 1000);
          },
          error: function (err){
            toastr.error('Error');
          },
      });
  })
</script>

@endsection
