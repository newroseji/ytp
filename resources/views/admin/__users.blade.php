<div class="card">
                <div class="card-header">


                    <div class="d-flex bd-highlight mb-3">
                        <div class="mr-auto p-2 bd-highlight"
                        data-toggle="collapse" 
                        data-target="#collapseUsers" 
                        aria-expanded="false" 
                        aria-controls="collapseUsers"
                        style="cursor:pointer"
                        ><h5>All Users</h5></div>
                        <div class="p-2 bd-highlight">
                            <span class="btn btn-sm btn-danger">deleted 
                                <span class="badge badge-pill badge-light">{{ App\User::erased()->count() }}</span></span>

                                <span class="btn btn-sm btn-success">active
                                    <span class="badge badge-pill badge-light">{{ App\User::noterased()->count() }}</span>
                                </span>

                                <span class="btn btn-sm btn-info">total
                                    <span class="badge badge-pill badge-light">{{ $users->count() }}</span>
                                </span>

                            </div>

                            <div class="p-2 bd-highlight"><a href="{{ route('users.create')}}" 
                                class="btn btn-primary btn-sm">Create User</a></div>
                            </div>


                        </div>

                        <div class="collapse show" id="collapseUsers">
                            <div class="card-body">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Fullname</th>
                                            <th>Email</th>

                                            <th>Verified</th>
                                            <th>Created Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)

                                        <tr class={{ $user->deleted ? 'table-danger' : '' }}>
                                            <td><a href="{{ route('users.show',$user->id)}}">{{$user->firstname . " " . $user->middlename . " " . $user->lastname}}</a></td>
                                            <td>{{$user->email}}</td>

                                            <td>{{$user->email_verified_at}}</td>
                                            <td>
                                                <div class="d-flex justify-content-between">

                                                    <span>
                                                        {{$user->created_at}}
                                                    </span>&nbsp;

                                                    @if (Auth::user() && (Auth::user()->id ==$user->id || Auth::user()->admin) )

                                                    <div class="d-flex justify-content-around">

                                                        <a href="{{ route('users.edit',$user->id) }}" 
                                                            class="btn btn-primary btn-sm">edit</a>&nbsp;

                                                            @if( Auth::user()->id !=$user->id)

                                                            @if(!$user->deleted)


                                                            <form action="{{ route('users.destroy', $user->id)}}" 
                                                                method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-danger btn-sm" type="submit">Del</button>
                                                            </form>
                                                            @else

                                                            <form action="{{ route('users.destroy', $user->id)}}" method="post">
                                                                @csrf
                                                                @method('DELETE')

                                                                <button class="btn btn-success btn-sm" type="submit">restore</button>
                                                            </form>
                                                            @endif
                                                            @endif
                                                        </div>
                                                        @endif

                                                    </div>

                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> 