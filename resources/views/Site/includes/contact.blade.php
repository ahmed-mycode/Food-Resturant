<section id="contact" class="contact-us bg-light py-5">
    <header class="section-header text-center">
        <h2 class="section-title font-body-heavy">{{trans('site.contact_us')}}</h2>
    </header><!-- .section-header -->
    <div class="section-content mt-5">

        <div class="container">
            <div class="col-sm-9 col-12 mx-auto">
                <form action="{{ url('/contact-us') }}" method="POST" class="contact-form clearfix">
                    {{ csrf_field() }}

                    @if(Session::has("insert-success"))

                        <div class="alert alert-success">
                            {{ Session::get("insert-success") }}
                        </div>

                    @endif

                    <div class="row">
                        <div class="form-group col-md-6 col-12">
                            <label for="your-name" class="sr-only">{{trans('site.name')}}</label>
                            <input type="text"
                                   id="your-name"
                                   class="form-control py-2 shadow-sm border-medium font-body-md"
                                   name="name"
                                   value="{{ old('name') }}"
                                   placeholder="{{trans('site.name')}}">
                            @if ($errors->has('name'))
                                <div class="top-margin alert alert-danger">
                                    <strong>{{ $errors->first('name') }}</strong>
                                 </div>
                            @endif
                        </div><!-- .form-group -->
                        <div class="form-group col-md-6 col-12">
                            <label for="your-phone" class="sr-only">{{trans('site.phone')}}</label>
                            <input type="text"
                                   id="your-phone"
                                   class="form-control py-2 shadow-sm border-medium font-body-md"
                                   name="phone"
                                   value="{{ old('phone') }}"
                                   placeholder="{{trans('site.phone')}}">

                            @if ($errors->has('phone'))
                                <div class="top-margin alert alert-danger">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                 </div>
                            @endif
                        </div><!-- .form-group -->
                    </div><!-- .row -->
                    <div class="row">
                        <div class="form-group col-md-6 col-12">
                            <label for="your-email" class="sr-only"> {{trans('site.email')}}</label>
                            <input type="email"
                                   id="your-email"
                                   class="form-control py-2 shadow-sm border-medium font-body-md"
                                   name="email"
                                   value="{{ old('email') }}"
                                   placeholder="{{trans('site.email')}}">

                            @if ($errors->has('email'))
                                <div class="top-margin alert alert-danger">
                                    <strong>{{ $errors->first('email') }}</strong>
                                 </div>
                            @endif

                        </div><!-- .form-group -->
                        <div class="form-group col-md-6 col-12">
                            <label for="your-subject" class="sr-only"> {{trans('site.subject')}}</label>
                            <input type="text"
                                   id="your-subject"
                                   name="subject"
                                   value="{{ old("subject") }}"
                                   class="form-control py-2 shadow-sm border-medium font-body-md"
                                   placeholder="{{trans('site.subject')}}">

                            @if ($errors->has('subject'))
                                <div class="alert alert-danger">
                                    <strong>{{ $errors->first('subject') }}</strong>
                                 </div>
                            @endif
                        </div><!-- .form-group -->
                    </div><!-- .row -->
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="your-message" class="sr-only">{{trans('site.message')}}</label>
                            <textarea class="form-control shadow-sm border-medium font-body-md"
                                      id="your-message"
                                      rows="5"
                                      name="message"
                                      value="{{ old('message') }}"
                                      placeholder="{{trans('site.message')}}"></textarea>
                            @if ($errors->has('message'))
                                <div class="top-margin alert alert-danger">
                                    <strong>{{ $errors->first('message') }}</strong>
                                 </div>
                            @endif
                        </div><!-- .form-group -->
                    </div><!-- .row -->
                    <button type="submit"
                            class="btn py-2 px-5 font-body-bold btn-primary float-left mb-4">{{trans('site.send')}}</button>
                </form><!-- .contact-form -->
            </div>
        </div><!-- .container -->

    </div><!-- .section-content -->
</section><!-- .contact-us -->