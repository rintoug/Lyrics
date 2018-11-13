@extends('layouts.admin_2column')
@section('content')
    <div class="row">
        <form method="post" action="{{ action('Admin\SongController@update',$song->id) }}" enctype="multipart/form-data">
        <div class="col-xs-8">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Responsive Hover Table</h3>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        <label for="txtname">Name</label>
                        <input class="form-control input-lg" type="text" placeholder="" name="txtname" value="{{ old('txtname', $song->name) }}">
                        @if ($errors->has('txtname'))
                            <span class="help-block"><strong>{{ $errors->first('txtname') }}</strong></span>
                        @endif
                    </div>





                    <div class="form-group">
                        <label for="video_url">Video URL</label>
                        <input class="form-control input-lg" type="text" placeholder="" name="video_url" value="{{ old('video_url', $song->video_url) }}">
                        @if ($errors->has('video_url'))
                            <span class="help-block"><strong>{{ $errors->first('video_url') }}</strong></span>
                        @endif
                    </div>


                    <div class="form-group">
                        <label for="description">Lyrics</label>
                        @if ($errors->has('lyrics'))
                            <span class="help-block"><strong>{{ $errors->first('lyrics') }}</strong></span>
                        @endif
                        <textarea class="form-control input-lg" rows="8" id="editor" name="lyrics">{{ old('lyrics', $song->lyrics) }}</textarea>
                    </div>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <div class="col-xs-4">
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">

                    <div class="form-group">
                        <label for="name">Year</label>
                        <input class="form-control input-lg" type="text" placeholder="" name="year" value="{{ old('year', $song->year) }}" maxlength="4">
                        @if ($errors->has('year'))
                            <span class="help-block"><strong>{{ $errors->first('year') }}</strong></span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="album_id">Album</label>
                        <select name="album_id" class="form-control input-lg select2">
                            @foreach($albums as $album)
                                <option value="{{ $album->id }}" @if(old('album_id', $album->id)==$song->album_id) selected @endif >{{ $album->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Artist</label>
                        <select name="artist[]" class="form-control input-lg select2" multiple="multiple">
                            @foreach($artists as $artist)
                            <option value="{{ $artist->id }}" @if(in_array($artist->id,$song_artists)) selected @endif >{{ $artist->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
            @csrf
            <input type="hidden" name="_method" value="PATCH">
        </form>
    </div>
@endsection
@section('footer')
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ),
                {
                    ckfinder: {
                        uploadUrl: '{{ url('/') }}/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
                    }
                }
            )
            .catch( error => {
            console.error( error );
        } );


        $(document).ready(function() {
            $('.select2').select2();
        });

    </script>
@endsection