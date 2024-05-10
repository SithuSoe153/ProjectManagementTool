<x-layout>

    <style>
        .card-title {
            display: flex;
            align-items: center;
            /* Vertically center align */
        }

        .title-info {
            margin-left: 10px;
            /* Adjust spacing between image and text */
        }

        .card-title span {
            display: block;
            /* Ensure the span is displayed below the image and name */
            /* margin-top: 5px; */
            /* Adjust the spacing between the name and the span */
        }

        .card-team .card-title {
            margin-bottom: 0;
            /* Remove bottom margin */
        }
    </style>
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-lg-11 col-xl-10">

                <br>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="teams" role="tabpanel"
                        data-filter-list="content-list-body">
                        <div class="row content-list-head">
                            <div class="col-auto">
                                <h3>Members</h3>
                                <a class="btn btn-round" href="/register">
                                    <i class="material-icons">add</i>
                                </a>
                            </div>
                            <form class="col-md-auto">
                                <div class="input-group input-group-round">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="material-icons">filter_list</i>
                                        </span>
                                    </div>
                                    <input type="search" class="form-control filter-list-input"
                                        placeholder="Filter teams" aria-label="Filter teams" />
                                </div>
                            </form>
                        </div>
                        <!--end of content list head-->
                        <div class="content-list-body row">
                            @foreach ($users as $user)
                                <div class="col-md-6">
                                    <div class="card card-team">

                                        <div class="card-body">
                                            <div class="dropdown card-options">
                                                <button class="btn-options" type="button" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <i class="material-icons">more_vert</i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="#">Manage</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item text-danger" href="#">Leave Team</a>
                                                </div>
                                            </div>


                                            <div class="card-title">
                                                {{-- <a href="#" class="avatar-link" data-toggle="tooltip" title="Kenny"> --}}
                                                <img alt="Kenny Tran" class="avatar avatar-lg"
                                                    src="https://source.unsplash.com/featured/?man?' . {{ $user->id }}" />
                                                {{-- </a> --}}

                                                <div class="title-info">
                                                    {{-- <a href="#"> --}}
                                                    <h5 data-filter-by="text">{{ $user->name }}</h5>
                                                    {{-- </a> --}}
                                                    <span>Role:Admin</span>
                                                    <span>Assigned Projects</span>
                                                </div>
                                            </div>

                                            {{-- Filter/Serarch --}}

                                            <script>
                                                $(document).ready(function() {
                                                    $('.filter-list-input').on('input', function() {
                                                        var searchText = $(this).val().toLowerCase();
                                                        $('.content-list-body .card-title').each(function() {
                                                            var filterText = $(this).find('h5').data('filter-text').toLowerCase();
                                                            if (filterText.includes(searchText)) {
                                                                $(this).parent().show(); // Show the parent element if the filter matches
                                                            } else {
                                                                $(this).parent()
                                                                    .hide(); // Hide the parent element if the filter doesn't match
                                                            }
                                                        });
                                                    });
                                                });
                                            </script>

                                        </div>


                                        {{-- <ul class="avatars">
                                            <li> --}}

                                        {{-- </li>

                                        </ul> --}}
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                    <!--end of content-list-body-->
                </div>


            </div>
        </div>
    </div>
    </div>






</x-layout>
