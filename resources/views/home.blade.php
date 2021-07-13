@extends('layouts.master')

@section('content')

<style>

    body {
      margin: 40px 10px;
      padding: 0;
      font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
      font-size: 14px;
    }
  
    #loading {
      display: none;
      position: absolute;
      top: 10px;
      right: 10px;
    }
  
    #calendar {
      max-width: 1100px;
      margin: 0 auto;
    }
  
  </style>


<div class="content">
    
    <div class="grid grid-cols-12 gap-6 mt-1">
        <div class="intro-y col-span-12 lg:col-span-7">
            <div class="box p-5">
                <h1>Noticias</h1>
                @foreach($noticias as $key => $noticia)
                    <br> 
                    <div class="intro-y blog col-span-12 md:col-span-6 box">
                        <div class="blog__preview image-fit">
                            
                            <img alt="{{$noticia->slug}}" class="rounded-t-md" src="{{$noticia->imagen}}">
                            <div class="absolute bottom-0 text-white px-5 pb-6 z-10"> 
                                <a href="{{route('noticias.show', $noticia->slug)}}">
                                    <span class="blog__category px-2 py-1 rounded">{{$noticia->titulo}}</span>
                                </a>
                                {{--<a href="" class="block font-medium text-xl mt-3">
                                    {{$noticia->titulo}}
                                </a>--}}
                            </div>
                        </div>
                        <div class="p-5 text-gray-700">{!! substr($noticia->descripcion, 0, 100) !!} ... <a href="{{route('noticias.show', $noticia->slug)}}">Leer más</a></div>
                    </div>   
                @endforeach           
            </div>
            <br>
            {{--<button class="button w-13 rounded-full shadow-md mr-1 mb-2 bg-theme-1 text-white">{{$noticias->links()}}--}}
            {{$noticias->links()}}

            
         </div>

        <div class="intro-y col-span-12 lg:col-span-5">
            <div class="intro-y box p-5">
                Calendario
                <br>
                <div id='loading'>Cargando...</div>

                <div id='calendar'></div>
            </div>

            <br>

            <div class="intro-y box p-5">
                <img src="{{asset('images/cumple.png')}}" alt="">
                <div class="intro-y box col-span-12 lg:col-span-6" style="overflow-y: scroll;height:350px;">
                    <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                        <h2 class="font-medium text-base mr-auto">
                          <b>Cumpleañeros del Mes</b>  
                        </h2>
                    </div>
                    @if(count($users) > 0)
                        @foreach($users as $key => $user)
                            <div class="p-5">
                                <div class="relative flex items-center">
                                    <div class="w-12 h-12 flex-none image-fit">
                                        <img alt="{{$user->name}}" class="rounded-full" src="{{$user->info->imagen}}">
                                    </div>
                                    <div class="ml-4 mr-auto">
                                        <a href="" class="font-medium">{{$user->name}}</a> 
                                        <div class="text-gray-600 mr-5 sm:mr-5">{{date('d-m', strtotime($user->info->fecha_nacimiento))}}</div>
                                        <div class="text-gray-600 mr-5 sm:mr-5">{{$user->info->area->nombre}}</div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    @else
                            <p>No hay cumpleañeros este mes!</p>
                    @endif

                    
                </div>
            </div>
        </div>
        
    </div>
</div>

@endsection

@push('scripts-js')
<script>

    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');
        
      var calendar = new FullCalendar.Calendar(calendarEl, {
        locale: 'es',
        firstDay: 1,
        buttonText: {
            today:    'Hoy',
            month:    'Mes',
            week:     'Semana',
            day:      'Día',
            list:     'Lista'
        },
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,listYear'
        },
  
        displayEventTime: false, // don't show the time column in list view
  
        // THIS KEY WON'T WORK IN PRODUCTION!!!
        // To make your own Google API key, follow the directions here:
        // http://fullcalendar.io/docs/google_calendar/
        googleCalendarApiKey: 'AIzaSyDcnW6WejpTOCffshGDDb4neIrXVUA1EAE',
  
        // US Holidays
        //events: 'en.usa#holiday@group.v.calendar.google.com',
        /*events : 
        [
            {
                title : 'Carlos Covis',
                start : '2020-11-09',
            },
            {
                title : 'Dayana Semprun',
                start : '2020-11-10',
            }
        ],*/
        eventBackgroundColor : 'red',
        /*eventClick: function(arg) {
          // opens events in a popup window
          window.open(arg.event.url, 'google-calendar-event', 'width=700,height=600');
  
          arg.jsEvent.preventDefault() // don't navigate in main tab
        },*/
  
        loading: function(bool) {
          document.getElementById('loading').style.display =
            bool ? 'block' : 'none';
        }
  
      });
  
      calendar.render();
    });
  
  </script>
@endpush
