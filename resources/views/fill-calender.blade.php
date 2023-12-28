@extends('layouts.app')

@section('content')
    <div class="container">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                    type="button" role="tab" aria-controls="pills-home" aria-selected="true">
                    Week 1
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile"
                    type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
                    Week 2
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact"
                    type="button" role="tab" aria-controls="pills-contact" aria-selected="false">
                    Week 3
                </button>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" tabindex="0">
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th scope="col">Client Code</th>
                            <th scope="col">Client Name</th>
                            <th scope="col" colspan="7">Month</th>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                            <!-- Repeat for the rest of the days -->
                            <th>Sat</th>
                            <th>Sun</th>
                            <th>Mon</th>
                            <th>Tue</th>
                            <th>Wed</th>
                            <th>Thu</th>
                            <th>Fri</th>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>1</th>
                            <th>2</th>
                            <th>3</th>
                            <th>4</th>
                            <th>5</th>
                            <th>6</th>
                            <th>7</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Client Code 1</td>
                            <td>Client Name 1</td>
                            <!-- Repeat for the rest of the days -->
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" tabindex="0">
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th scope="col">Client Code</th>
                            <th scope="col">Client Name</th>
                            <th scope="col" colspan="7">Month</th>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                            <!-- Repeat for the rest of the days -->
                            <th>Sat</th>
                            <th>Sun</th>
                            <th>Mon</th>
                            <th>Tue</th>
                            <th>Wed</th>
                            <th>Thu</th>
                            <th>Fri</th>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>1</th>
                            <th>2</th>
                            <th>3</th>
                            <th>4</th>
                            <th>5</th>
                            <th>6</th>
                            <th>7</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Client Code 1</td>
                            <td>Client Name 1</td>
                            <!-- Repeat for the rest of the days -->
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                        </tr>

                        <tr>
                            <td>Client Code 1</td>
                            <td>Client Name 1</td>
                            <!-- Repeat for the rest of the days -->
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" tabindex="0">
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th scope="col">Client Code</th>
                            <th scope="col">Client Name</th>
                            <th scope="col" colspan="7">Month</th>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                            <!-- Repeat for the rest of the days -->
                            <th>Sat</th>
                            <th>Sun</th>
                            <th>Mon</th>
                            <th>Tue</th>
                            <th>Wed</th>
                            <th>Thu</th>
                            <th>Fri</th>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>1</th>
                            <th>2</th>
                            <th>3</th>
                            <th>4</th>
                            <th>5</th>
                            <th>6</th>
                            <th>7</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Client Code 1</td>
                            <td>Client Name 1</td>
                            <!-- Repeat for the rest of the days -->
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                        </tr>

                        <tr>
                            <td>Client Code 1</td>
                            <td>Client Name 1</td>
                            <!-- Repeat for the rest of the days -->
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                        </tr>

                        <tr>
                            <td>Client Code 1</td>
                            <td>Client Name 1</td>
                            <!-- Repeat for the rest of the days -->
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                        </tr>

                        <tr>
                            <td>Client Code 1</td>
                            <td>Client Name 1</td>
                            <!-- Repeat for the rest of the days -->
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                        </tr>
                        <tr>
                            <td>Client Code 1</td>
                            <td>Client Name 1</td>
                            <!-- Repeat for the rest of the days -->
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                        </tr>
                        <tr>
                            <td>Client Code 1</td>
                            <td>Client Name 1</td>
                            <!-- Repeat for the rest of the days -->
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                        </tr>
                        <tr>
                            <td>Client Code 1</td>
                            <td>Client Name 1</td>
                            <!-- Repeat for the rest of the days -->
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                        </tr>
                        <tr>
                            <td>Client Code 1</td>
                            <td>Client Name 1</td>
                            <!-- Repeat for the rest of the days -->
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                        </tr>
                        <tr>
                            <td>Client Code 1</td>
                            <td>Client Name 1</td>
                            <!-- Repeat for the rest of the days -->
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                        </tr>
                        <tr>
                            <td>Client Code 1</td>
                            <td>Client Name 1</td>
                            <!-- Repeat for the rest of the days -->
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                        </tr>
                        <tr>
                            <td>Client Code 1</td>
                            <td>Client Name 1</td>
                            <!-- Repeat for the rest of the days -->
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                        </tr>
                        <tr>
                            <td>Client Code 1</td>
                            <td>Client Name 1</td>
                            <!-- Repeat for the rest of the days -->
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                        </tr>
                        <tr>
                            <td>Client Code 1</td>
                            <td>Client Name 1</td>
                            <!-- Repeat for the rest of the days -->
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                        </tr>
                        <tr>
                            <td>Client Code 1</td>
                            <td>Client Name 1</td>
                            <!-- Repeat for the rest of the days -->
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                        </tr>
                        <tr>
                            <td>Client Code 1</td>
                            <td>Client Name 1</td>
                            <!-- Repeat for the rest of the days -->
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                        </tr>
                        <tr>
                            <td>Client Code 1</td>
                            <td>Client Name 1</td>
                            <!-- Repeat for the rest of the days -->
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                        </tr>
                        <tr>
                            <td>Client Code 1</td>
                            <td>Client Name 1</td>
                            <!-- Repeat for the rest of the days -->
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                        </tr>
                        <tr>
                            <td>Client Code 1</td>
                            <td>Client Name 1</td>
                            <!-- Repeat for the rest of the days -->
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                        </tr>
                        <tr>
                            <td>Client Code 1</td>
                            <td>Client Name 1</td>
                            <!-- Repeat for the rest of the days -->
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                            <td>
                                <div class="inner_cell" data-current-symbo="_">_</div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
