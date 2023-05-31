@extends('../layouts/app')



@section('content')

<section class="bg-gray-50 dark:bg-gray-900">

  <div class="h-screen flex flex-col items-center justify-center px-6 py-8 mx-auto lg:py-0">

    <div class="w-full items-center justify-center">

      <a href="{{url('/admin/event/create')}}" class="btn-start-link mx-auto">

        Create new event

      </a>

      <a href="{{url('/admin/event')}}" class="btn-start-link mx-auto mt-10">

        Browse events

      </a>

    </div>

  </div>

</section>

@endsection