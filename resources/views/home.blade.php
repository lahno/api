@extends('layouts.app')

@section('content')
    <div class="container">
        @if(Auth::user()->access_admin)
            <div class="row">
                <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Contacts</div>
                        <div class="panel-body">
                            @if (session('status'))
                                <div class="alert alert-info">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <div class="table-responsive">
                                <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Firstname</th>
                                        <th>Secondname</th>
                                        <th>Lastname</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($contacts as $contact)
                                    <tr>
                                        <td>{{$contact->id}}</td>
                                        <td>{{$contact->firstname}}</td>
                                        <td>{{$contact->secondname}}</td>
                                        <td>{{$contact->lastname}}</td>
                                        <td>{{$contact->phone}}</td>
                                        <td>{{$contact->email}}</td>
                                        <td>
                                            {{--<button type="button" class="btn btn-link btn-xs"><span class="glyphicon glyphicon-pencil"></span></button>--}}
                                            <button type="button" class="btn btn-link btn-xs" data-toggle="modal" data-target="#modalShow_{{$contact->id}}"><span class="glyphicon glyphicon-search"></span></button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-info">
                <p>У Вас нет нужного доступа, свяжитесь с администратором</p>
            </div>
        @endif
    </div>

    @foreach($contacts as $contact)
        <div class="modal fade" id="modalShow_{{$contact->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">{{$contact->firstname}} {{$contact->secondname}} {{$contact->lastname}}</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered table-hover table-condensed table-responsive">
                            <tbody>
                            <tr>
                                <td><strong>ID</strong></td>
                                <td>{{$contact->id}}</td>
                            </tr>
                            <tr>
                                <td><strong>Firstname</strong></td>
                                <td>{{$contact->firstname}}</td>
                            </tr>
                            <tr>
                                <td><strong>Secondname</strong></td>
                                <td>{{$contact->secondname}}</td>
                            </tr>
                            <tr>
                                <td><strong>Lastname</strong></td>
                                <td>{{$contact->lastname}}</td>
                            </tr>
                            <tr>
                                <td><strong>Phone</strong></td>
                                <td>{{$contact->phone}}</td>
                            </tr>
                            <tr>
                                <td><strong>Email</strong></td>
                                <td>{{$contact->email}}</td>
                            </tr>
                            <tr>
                                <td><strong>Region</strong></td>
                                <td>{{$contact->region}}</td>
                            </tr>
                            <tr>
                                <td><strong>City</strong></td>
                                <td>{{$contact->city}}</td>
                            </tr>
                            <tr>
                                <td><strong>IP</strong></td>
                                <td>{{$contact->ip}}</td>
                            </tr>
                            <tr>
                                <td><strong>Device</strong></td>
                                <td>{{$contact->device}}</td>
                            </tr>
                            <tr>
                                <td><strong>Birthday</strong></td>
                                <td>{{$contact->birthday}}</td>
                            </tr>
                            <tr>
                                <td><strong>Address</strong></td>
                                <td>{{$contact->address}}</td>
                            </tr>
                            <tr>
                                <td><strong>Contact_site</strong></td>
                                <td>{{$contact->contact_site}}</td>
                            </tr>
                            <tr>
                                <td><strong>Created</strong></td>
                                <td>{{$contact->created_at}}</td>
                            </tr>
                            <tr>
                                <td><strong>Updated</strong></td>
                                <td>{{$contact->updated_at}}</td>
                            </tr>
                            <tr>
                                <td><strong>Photo</strong></td>
                                <td>
                                    @if($contact->photo)
                                        <img src="{{asset('file_download/photo_users/'.$contact->photo)}}" class="img-responsive img-thumbnail">
                                    @endif
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger btn-sm showModalFormDeletingContact" data-toggle="modal" data-target="modalDeleteContact_{{$contact->id}}">Delete contact</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <div class="modal fade" id="modalDeleteContact_{{$contact->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="width: 300px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Delete contact {{$contact->id}}</h4>
                    </div>
                    <div class="modal-body text-center">
                        <form id="delete_contact_{{$contact->id}}" action="{{route('deletingContact', ['contact' => $contact->id])}}" method="post">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger">Yes</button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    @endforeach

@endsection
