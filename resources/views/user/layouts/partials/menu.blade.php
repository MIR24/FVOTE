</ul><li class="{{ Request::is('nominations*') ? 'active' : '' }}">
    <a href="{!! route('nominations.index') !!}"><i class="fa fa-edit"></i><span>Nominations</span></a>
</li>

<li class="{{ Request::is('users*') ? 'active' : '' }}">
    <a href="{!! route('users.index') !!}"><i class="fa fa-edit"></i><span>Users</span></a>
</li>

