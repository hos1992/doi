@component('mail::message')
# New Company added

@component('mail::button', ['url' => action('Admin\CompaniesController@index')])
Click here to see latest companies
@endcomponent

Thanks,<br>

@endcomponent
