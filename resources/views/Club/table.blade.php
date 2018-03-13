@extends('layouts.app')
@section('title') ClubUploadLogo @endsection
@section('css')
    <meta id="token" name="token" content="{ { csrf_token() } }">
    <style>
        .table-light{
            color: black;
            background-color: white;
        }
        form{
            float: left;
            width:100%;
            height:50px;
            display: block;
            background-color: rgba(255, 255, 255, .9);
            border-bottom: 2px solid black;
        }
        form input, form button{
            width:calc( 100vw / 9 - 15px);
        }
        form input{
            background-color: transparent;
            outline:none;
            border:none;
        }
        form input[type="file"]{
            display: inline;

        }
    </style>
@endsection
@section('scripts')

    <script>
        var mData;
    $('document').ready(function () {
        var token = '{{ Session::token() }}';
        var url1 = '{{route('store')}}';

        $('form').each(function () {
            $id = $(this).attr('id');
            var form = document.getElementById($id);
            var request = new XMLHttpRequest();

            form.addEventListener('submit', function (e){
                mData = $(this);
                e.preventDefault();
                var formdata = new FormData(form);
                request.open('post', "{{ url('/store') }}");
                request.setRequestHeader('X-CSRF-TOKEN', token);
                request.addEventListener("load", transferComplete);
                request.send(formdata);
            });
        });

        function transferComplete(data) {
            var response = JSON.parse(data.currentTarget.response);
            if(response.success){
                console.log(response);
                mData.find('input[name="url_club"]').val(response.url);
                mData.find('input[name="nom_image"]').val(response.nom);
            }
        }

        /*function sumbitImg(){
            $('body').on('click','.table-light tr button[type="submit"]',function () {
                $this = $(this);
                $tr = $this.parents('tr');
                var data2 = {_token: token};


                data2.id_club = $tr.find('input[name="id_club"]').val();
                data2.nom_club = $tr.find('input[name="nom_club"]').val();
                data2.url_club = $tr.find('input[name="url_club"]').val();
                data2.nom_ville = $tr.find('input[name="nom_ville"]').val();
                data2.pays = $tr.find('input[name="pays"]').val();
                data2.acronyme = $tr.find('input[name="acronyme"]').val();
                data2.nom_image = $tr.find('input[name="nom_image"]').val();
                data2.file = $tr.find('input[name="file"]')[0].files[0];
                console.log(data2);
                //sumbitAjax(data2);
            });

        }*/



    });

    </script>
@endsection

@section('container')
    <div class="section sct-pd">
        <div class="container-fluid">
            <div class="row">
                <table class="table table-light">
                    <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">nom_club</th>
                        <th scope="col">url_club</th>
                        <th scope="col">nom_ville</th>
                        <th scope="col">pays</th>
                        <th scope="col">acronyme</th>
                        <th scope="col">nom_image</th>
                        <th scope="col">UR FILE</th>
                        <th scope="col">submit</th>
                    </tr>
                    </thead>
                    <tbody>


                    </tbody>
                </table>
                @foreach($clubs as $club)


                    <form id="ClubImage{{$club->id_club}}" action="{{route('store')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="text" name="id_club" value="{{$club->id_club}}">
                        <input type="text" name="nom_club" value="{{$club->nom_club}}">
                        <input type="text" name="url_club" value="{{$club->url_club}}">
                        <input type="text" name="nom_ville" value="{{$club->nom_ville}}">
                        <input type="text" name="pays" value="{{$club->pays}}">
                        <input type="text" name="acronyme" value="{{$club->acronyme}}">
                        <input type="text" name="nom_image" value="{{$club->nom_image}}">
                        <input type="file" name="clubfile">
                        <button type="submit">submit</button>
                    </form>


                @endforeach
            </div>
        </div>
    </div>
@endsection






