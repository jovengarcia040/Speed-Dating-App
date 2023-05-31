@extends('../layouts/app')

@section('content')
<section class="bg-gray-50 dark:bg-gray-900">
  <div class="flex flex-col items-center px-6 py-8 mx-auto h-screen">
      <h1 href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
          Hello {{Session::get('guest')->first_name}}
      </h1>
      <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
              
              <div class="cs-dropdown mx-auto">
                <button id="btn-dropdown" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="button">
                  בחר שם ליצירת התאמה 
                </button>
                <ul class="p-3 space-y-1 bg-white border border-gray-300 text-sm text-gray-700 dark:text-gray-200"
                  id="guestList"
                >
                  @foreach($guests as $guest)
                  <li data-event-id="{{$event->id}}" data-guest-id="{{$guest->id}}">
                    <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                      <label class="w-full ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">{{$guest->first_name}} {{substr($guest->last_name, 0, 1)}}</label>
                    </div>
                  </li>
                  @endforeach
                </ul>
              </div>

              <div class="guest-list mx-auto text-center">
                  <label class="block mb-2 font-extrabold text-3xl text-red-600">List of guests</label>
                  <ul id="coupleList text-base" >
                    @foreach($couples as $couple)
                    <li class=" text-lg cursor-pointer">
                        {{strtolower(Session::get('guest')->gender) === 'male' 
                          ? $couple->female->first_name . ' ' . $couple->female->last_name 
                          : $couple->male->first_name . ' ' . $couple->male->last_name 
                        }}
                        <button class="btnDelete" data-id="{{$couple->id}}">
                          <i class="fa fa-trash-o"></i>
                        </button>
                      </li>
                    @endforeach
                  </ul>
              </div>
          </div>
      </div>
  </div>
</section>
<script>
  var base_url = "{{url('/')}}";
  $(document).on('click', '#btn-dropdown', function() {
    $('#guestList').toggleClass('open');
  });
</script>
<script>
  var ggd = "{{ strtolower(Session::get('guest')->gender) }}";
  // $(function() {
  //   getGuestEventData();
  // });
  function getGuestEventData () {
    $.ajax({
          url: `${base_url}/client/getGuestEventData`,
          type: 'POST',
          data: { 
            _token: '{{ csrf_token() }}',
          },
          success:function(res){
            if(res.success) {
              location.reload()
            }
          },
          error: function (err){
            toastr.error('Error');
          }, 
      });
  }
</script>
<script>
  $(document).on('click', '#guestList li', function(e) {
    inviteCouple($(this).data('guest-id'), $(this).data('event-id'), true);
  });

  function inviteCouple (guest_id, event_id, status) {
    $.ajax({
          url: `${base_url}/client/event/invite`,
          type: 'POST',
          data: { 
            _token: '{{ csrf_token() }}',
            guest_id: guest_id, 
            event_id: event_id,
            status: status, 
          },
          success:function(res){
            if(res.success) {
              toastr.success('Successfully invited.');
              getGuestEventData();
            }
          },
          error: function (err){
            toastr.error('Error');
          }, 
      });
  }
</script>
<script>
  $(document).on('click', '.btnDelete', function(e) {
    deleteInvite($(this).data('id'));
  });

  function deleteInvite (couple_id) {
    $.ajax({
          url: `${base_url}/client/event/invite/${couple_id}`,
          type: 'DELETE',
          data: { 
            _token: '{{ csrf_token() }}',
          },
          success:function(res){
            if(res.success) {
              toastr.success('Successfully removed.');
              getGuestEventData();
            }
          },
          error: function (err){
            toastr.error('Error');
          }, 
      });
  }
</script>
@endsection