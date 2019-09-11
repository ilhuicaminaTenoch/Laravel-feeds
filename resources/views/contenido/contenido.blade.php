@extends('principal')
@section('contenido')
    @if(Auth::check())
        @if(Auth::user()->idrol == 1 )
            <template v-if="menu==0">
                <h1>Escritorio</h1>
            </template>

            <template v-if="menu==1">
                <categoria></categoria>
            </template>
        @endif
    @endif







    <template v-if="menu==2">
        <h1>Contenido el menu 2</h1>
    </template>

    <template v-if="menu==3">
        <h1>Contenido el menu 3</h1>
    </template>

    <template v-if="menu==4">
        <h1>Contenido el menu 4</h1>
    </template>

    <template v-if="menu==5">
        <h1>Contenido el menu 5</h1>
    </template>

    <template v-if="menu==6">
        <h1>Contenido el menu 6</h1>
    </template>

    <template v-if="menu==7">
        <h1>Contenido el menu 7</h1>
    </template>

    <template v-if="menu==8">
        <h1>Contenido el menu 8</h1>
    </template>

    <template v-if="menu==9">
        <h1>Contenido el menu 9</h1>
    </template>

    <template v-if="menu==10">
        <h1>Contenido el menu 10</h1>
    </template>

    <template v-if="menu==11">
        <h1>Contenido el menu 11</h1>
    </template>

    <template v-if="menu==12">
        <h1>Contenido el menu 12</h1>
    </template>



@endsection