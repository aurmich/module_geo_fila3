<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
@extends('setting::layouts.master')
=======
@extends('job::layouts.master')
>>>>>>> 648bc7d47c (Squashed 'laravel/Modules/Job/' content from commit df60037ec)
=======
@extends('user::layouts.master')
>>>>>>> 8c6e1cc41e (Squashed 'laravel/Modules/User/' content from commit 193294f1c)
=======
@extends('media::layouts.master')
>>>>>>> 7695ceaeea (Squashed 'laravel/Modules/Media/' content from commit 16aedf8e8)

@section('content')
    <h1>Hello World</h1>

<<<<<<< HEAD
    <p>
<<<<<<< HEAD
<<<<<<< HEAD
        This view is loaded from module: {!! config('setting.name') !!}
=======
        This view is loaded from module: {!! config('job.name') !!}
>>>>>>> 648bc7d47c (Squashed 'laravel/Modules/Job/' content from commit df60037ec)
=======
        This view is loaded from module: {!! config('user.name') !!}
>>>>>>> 8c6e1cc41e (Squashed 'laravel/Modules/User/' content from commit 193294f1c)
    </p>
=======
    <p>Module: {!! config('media.name') !!}</p>
>>>>>>> 7695ceaeea (Squashed 'laravel/Modules/Media/' content from commit 16aedf8e8)
@endsection
