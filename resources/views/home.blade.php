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
            <div class="box p-3">
                <h1><b>Indicadores Diarios</b></h1>
            </div>
            <div class="box p-5 my-1">

                <marquee behavior="" direction="left">
                    
                        <p> {{'UF $' . $dailyIndicators->uf->valor . ' - '}} 
                            {{'Dólar observado $' . $dailyIndicators->dolar->valor . ' - '}}
                            {{'Euro $' . $dailyIndicators->euro->valor . ' - '}}
                            {{'IPC ' . $dailyIndicators->ipc->valor . ' - '}}
                            {{'UTM $' . $dailyIndicators->utm->valor . ' - '}} 
                            {{'IVP $' . $dailyIndicators->ivp->valor . ' - '}} 
                            {{'Imacec ' . $dailyIndicators->imacec->valor }}
                        </p>
                   
                </marquee>

                
            </div>
            <div class="box p-5">
                <h1><b>Noticias</b></h1>
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
            <div class="box p-3">
                <h1><b>Clima en Santiago</b></h1>
            </div>
            <div class="box p-5 my-1">
                
                    <p>
                        {{  $dailyClimate['symbol_description'] . ' - ' .
                            'T° Min: ' .   $dailyClimate['tempmin']  . '°C - ' .
                            'T° Max: ' .   $dailyClimate['tempmax']  . '°C '
                        }}
                    </p>
                
            </div>
            <div class="intro-y box p-5">
                Calendario
                <br>
                <div id='loading'>Cargando...</div>

                <div id='calendar'></div>
            </div>

            <br>

            <div class="intro-y box p-5" id="getBirthdays">
                
                <img src="{{asset('images/cumple.png')}}" alt="">
                <div class="intro-y box col-span-12 lg:col-span-6" style="overflow-y: scroll;height:350px;">
                    <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                        <h2 class="font-medium text-base mr-auto">
                            <b>Cumpleañeros del Mes</b>
                            <select v-model="month" class='input w-full border mt-2' v-on:change="cumpleMes">
                                <option v-for="option in options" v-bind:value="option.value" >
                                @{{ option.text }}
                                </option>
                            </select>
                        </h2>
                    </div>
                
                    <div class="p-1" v-for="(user, index) in birthdays" :key="user.id" >
                        <div class="relative flex items-center">
                            <div class="w-12 h-12 flex-none image-fit m-1">
                                <img :alt="user.name" class="rounded-full" :src="user.image">
                            </div>
                            <div class="ml-4 mr-auto">
                                <p class="font-medium"> @{{ user.birthday }} : @{{ user.name }}</p>
                            </div>
                        </div>
                        <hr>
                    </div>
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
  
        googleCalendarApiKey: 'AIzaSyDcnW6WejpTOCffshGDDb4neIrXVUA1EAE',
  
        // US Holidays
        //events: 'en.usa#holiday@group.v.calendar.google.com',
        /*events : 
        [
            {
                title : 'Carlos Covis',
                start : '2021-07-27',
            },
            {
                title : 'Dayana Semprun',
                start : '2021-07-28',
            }
        ],*/
        
        //eventBackgroundColor : 'red',
        /*eventClick: function(arg) {
          // opens events in a popup window
          window.open(arg.event.url, 'google-calendar-event', 'width=700,height=600');
  
          arg.jsEvent.preventDefault() // don't navigate in main tab
        },*/
  
        loading: function(bool) {
          document.getElementById('loading').style.display = bool ? 'block' : 'none';
        }
  
        });
  
        calendar.render();

        /*var cdate = calendar.getDate();
        var month_int = cdate.getMonth();
        var month = ((month_int+1)); 
        console.log(month)*/
    });


    var app = new Vue({
        el: '#getBirthdays',
        data: {
            month: 0,
            options: [
                { text: 'Enero', value: 1 },
                { text: 'Febrero', value: 2 },
                { text: 'Marzo', value: 3 },
                { text: 'Abril', value: 4 },
                { text: 'Mayo', value: 5 },
                { text: 'Junio', value: 6 },
                { text: 'Julio', value: 7 },
                { text: 'Agosto', value: 8 },
                { text: 'Septiembre', value: 9 },
                { text: 'Octubre', value: 10 },
                { text: 'Noviembre', value: 11 },
                { text: 'Diciembre', value: 12 }
            ],
            birthdays: [],
        },
        created : function () {
            let vm = this;
            vm.cumpleMes();
            vm.getMonth();
        },
        methods: {
            getMonth: function ()
            {
                let vm = this;
                const current = new Date();
                return vm.month = (current.getMonth() + 1);
            },
            cumpleMes: function () {
                let vm = this;
                axios.get('/api/getCumpleMes/' + this.month)
                .then(function (response) {
                    vm.birthdays = response.data;
                })
            }
        }
    })
  
  </script>
@endpush
