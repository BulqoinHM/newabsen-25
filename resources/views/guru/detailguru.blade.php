@extends('layouts.master')

@section('title')
    Detail Guru
@endsection

@section('content')
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="row">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if (session('failed'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session('failed') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if (count($errors) > 0)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul>
                            <li><strong>Submit Data Gagal !</strong></li>
                            @foreach ($errors->all() as $error)
                                <li><strong>{{ $error }}</strong></li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Detail Data Guru</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Profil Guru
                                </li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right">



                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
                        <div class="pd-20 card-box height-100-p">
                            <div class="profile-photo">
                                <a href="modal" data-toggle="modal" data-target="#modal" class="edit-avatar"><i
                                        class="fa fa-pencil"></i></a>
                                <img src="{{ asset($data->foto) }}" alt="" class="avatar-photo" />
                                <div class="modal fade" id="modal" tabindex="-1" role="dialog"
                                    aria-labelledby="modalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body pd-5">
                                                <div class="img-container">
                                                    <img id="image" src="{{ asset($data->foto) }}" alt="Picture" />
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                                    Close
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h5 class="text-center h5 mb-0">{{ $data->nama_guru }}</h5>
                            <p class="text-center text-muted font-14">
                                {{ $data->kode_guru }}
                            </p>
                            <div class="profile-info">
                                <h5 class="mb-20 h5 text-blue">Contact Information</h5>
                                <ul>
                                    <li>
                                        <span>Email Address:</span>
                                        {{ $data->email }}
                                    </li>
                                    <li>
                                        <span>Phone Number:</span>
                                        {{ $data->notelp }}
                                    </li>
                                    <li>
                                        <span>Jabatan:</span>
                                        {{ $data->jabatan }}
                                    </li>
                                    <li>
                                        <span>Jenis Kelamin:</span>
                                        {{ $data->jk }}
                                    </li>
                                    <li>
                                        <span>Role:</span>
                                        {{ $data->role }}
                                    </li>
                                </ul>
                            </div>
                            <div class="profile-social">
                                <!-- <h5 class="mb-20 h5 text-blue">Social Links</h5>
                                            <ul class="clearfix">
                                                <li>
                                                    <a
                                                        href="#"
                                                        class="btn"
                                                        data-bgcolor="#3b5998"
                                                        data-color="#ffffff"><i class="fa fa-facebook"></i></a>
                                                </li>
                                                <li>
                                                    <a
                                                        href="#"
                                                        class="btn"
                                                        data-bgcolor="#1da1f2"
                                                        data-color="#ffffff"><i class="fa fa-twitter"></i></a>
                                                </li>
                                                <li>
                                                    <a
                                                        href="#"
                                                        class="btn"
                                                        data-bgcolor="#007bb5"
                                                        data-color="#ffffff"><i class="fa fa-linkedin"></i></a>
                                                </li>
                                                <li>
                                                    <a
                                                        href="#"
                                                        class="btn"
                                                        data-bgcolor="#f46f30"
                                                        data-color="#ffffff"><i class="fa fa-instagram"></i></a>
                                                </li>
                                                <li>
                                                    <a
                                                        href="#"
                                                        class="btn"
                                                        data-bgcolor="#c32361"
                                                        data-color="#ffffff"><i class="fa fa-dribbble"></i></a>
                                                </li>
                                                <li>
                                                    <a
                                                        href="#"
                                                        class="btn"
                                                        data-bgcolor="#3d464d"
                                                        data-color="#ffffff"><i class="fa fa-dropbox"></i></a>
                                                </li>
                                                <li>
                                                    <a
                                                        href="#"
                                                        class="btn"
                                                        data-bgcolor="#db4437"
                                                        data-color="#ffffff"><i class="fa fa-google-plus"></i></a>
                                                </li>
                                                <li>
                                                    <a
                                                        href="#"
                                                        class="btn"
                                                        data-bgcolor="#bd081c"
                                                        data-color="#ffffff"><i class="fa fa-pinterest-p"></i></a>
                                                </li>
                                                <li>
                                                    <a
                                                        href="#"
                                                        class="btn"
                                                        data-bgcolor="#00aff0"
                                                        data-color="#ffffff"><i class="fa fa-skype"></i></a>
                                                </li>
                                                <li>
                                                    <a
                                                        href="#"
                                                        class="btn"
                                                        data-bgcolor="#00b489"
                                                        data-color="#ffffff"><i class="fa fa-vine"></i></a>
                                                </li>
                                            </ul> -->
                            </div>
                            <div class="profile-skills">
                                <!-- <h5 class="mb-20 h5 text-blue">Key Skills</h5>
                                            <h6 class="mb-5 font-14">HTML</h6>
                                            <div class="progress mb-20" style="height: 6px">
                                                <div
                                                    class="progress-bar"
                                                    role="progressbar"
                                                    style="width: 90%"
                                                    aria-valuenow="0"
                                                    aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                            <h6 class="mb-5 font-14">Css</h6>
                                            <div class="progress mb-20" style="height: 6px">
                                                <div
                                                    class="progress-bar"
                                                    role="progressbar"
                                                    style="width: 70%"
                                                    aria-valuenow="0"
                                                    aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                            <h6 class="mb-5 font-14">jQuery</h6>
                                            <div class="progress mb-20" style="height: 6px">
                                                <div
                                                    class="progress-bar"
                                                    role="progressbar"
                                                    style="width: 60%"
                                                    aria-valuenow="0"
                                                    aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                            <h6 class="mb-5 font-14">Bootstrap</h6>
                                            <div class="progress mb-20" style="height: 6px">
                                                <div
                                                    class="progress-bar"
                                                    role="progressbar"
                                                    style="width: 80%"
                                                    aria-valuenow="0"
                                                    aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
                        <div class="card-box height-100-p overflow-hidden">
                            <div class="profile-tab height-100-p">
                                <div class="tab height-100-p">
                                    <ul class="nav nav-tabs customtab" role="tablist">

                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#tasks"
                                                role="tab">Jadwal</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#setting" role="tab">Ubah
                                                Profil</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">

                                        <!-- Tasks Tab start -->
                                        <div class="tab-pane fade show active" id="tasks" role="tabpanel">
                                            <div class="pd-20 profile-task-wrap">
                                                <div class="container pd-0">
                                                    <!-- Open Task start -->
                                                    <div class="task-title row align-items-center">
                                                        <div class="col-md-8 col-sm-12">
                                                            <h5>List Jadwal</h5>
                                                        </div>
                                                        <div class="col-md-4 col-sm-12 text-right">
                                                            <a href="#" data-toggle="modal" data-target="#task-add"
                                                                class="bg-light-blue btn text-blue weight-500"><i
                                                                    class="ion-plus-round"></i> Tambah Data</a>
                                                            <!-- add task popup start -->
                                                            <div class="modal fade customscroll" id="task-add"
                                                                tabindex="-1" role="dialog">
                                                                <div class="modal-dialog modal-dialog-centered"
                                                                    role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="exampleModalLongTitle">
                                                                                Tambah Jadwal
                                                                            </h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close"
                                                                                data-toggle="tooltip"
                                                                                data-placement="bottom" title=""
                                                                                data-original-title="Close Modal">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body pd-0">
                                                                            <div class="task-list-form">
                                                                                <ul>
                                                                                    <li>
                                                                                        <form
                                                                                            action="{{ url('jadwal/store') }}"
                                                                                            method="POST"
                                                                                            enctype="multipart/form-data">
                                                                                            @csrf
                                                                                            <input type="hidden"
                                                                                                value="{{ encrypt($data->id) }}"
                                                                                                name="id_guru">
                                                                                            @if (count($errors) > 0)
                                                                                                <div class="alert alert-danger alert-dismissible fade show"
                                                                                                    role="alert">
                                                                                                    <ul>
                                                                                                        <li><strong>Submit
                                                                                                                Data
                                                                                                                Gagal
                                                                                                                !</strong>
                                                                                                        </li>
                                                                                                        @foreach ($errors->all() as $error)
                                                                                                            <li><strong>{{ $error }}</strong>
                                                                                                            </li>
                                                                                                        @endforeach
                                                                                                    </ul>
                                                                                                </div>
                                                                                            @endif
                                                                                            <div class="form-group row">
                                                                                                <label
                                                                                                    class="col-md-4">Hari</label>
                                                                                                <div class="col-md-8">
                                                                                                    <select
                                                                                                        class="form-control"
                                                                                                        data-style="btn-outline-primary"
                                                                                                        name="hari">
                                                                                                        <option
                                                                                                            selected="">
                                                                                                            Pilih Hari
                                                                                                        </option>
                                                                                                        @foreach ($dropdown['Hari'] as $hari)
                                                                                                            <option
                                                                                                                value="{{ $hari->nilai }}">
                                                                                                                {{ $hari->nilai }}
                                                                                                            </option>
                                                                                                        @endforeach
                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group row">
                                                                                                <label class="col-md-4">Jam
                                                                                                    Mulai</label>
                                                                                                <div class="col-md-8">
                                                                                                    <input type="time"
                                                                                                        name="jam_mulai"
                                                                                                        class="form-control" />
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group row">
                                                                                                <label class="col-md-4">Jam
                                                                                                    Selesai</label>
                                                                                                <div class="col-md-8">
                                                                                                    <input type="time"
                                                                                                        name="jam_selesai"
                                                                                                        class="form-control" />
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group row">
                                                                                                <label
                                                                                                    class="col-md-4">Mapel</label>
                                                                                                <div class="col-md-8">
                                                                                                    <select
                                                                                                        class="form-control"
                                                                                                        data-style="btn-outline-primary"
                                                                                                        name="id_mapel">
                                                                                                        <option
                                                                                                            selected="">
                                                                                                            Pilih Mapel
                                                                                                        </option>
                                                                                                        @foreach ($dropdown['Mapel'] as $mapel)
                                                                                                            <option
                                                                                                                value="{{ $mapel->id }}">
                                                                                                                {{ $mapel->nama_mapel . '/' . $mapel->kelas . '-' . $mapel->jurusan }}
                                                                                                            </option>
                                                                                                        @endforeach
                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>

                                                                                    </li>

                                                                                </ul>
                                                                            </div>

                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="submit"
                                                                                class="btn btn-primary">
                                                                                Simpan
                                                                            </button>
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-dismiss="modal">
                                                                                Tutup
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <!-- add task popup End -->
                                                        </div>
                                                    </div>
                                                    <table
                                                        class="table hover multiple-select-row data-table-export nowrap">
                                                        <thead>
                                                            <tr>
                                                                <th class="table-plus datatable-nosort">Hari</th>
                                                                <th>Jam Mulai</th>
                                                                <th>Jam Selesai</th>
                                                                <th>Mapel</th>
                                                                <th>Durasi</th>
                                                                <th>Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($schedules as $d)
                                                                <tr>
                                                                    <td class="table-plus">{{ $d->hari }}</td>
                                                                    <td>{{ $d->jam_mulai }}</td>
                                                                    <td>{{ $d->jam_selesai }}</td>
                                                                    <td>{{ $d->nama_mapel . '/' . $d->kelas . '-' . $d->jurusan }}
                                                                    </td>
                                                                    <td>{{ $d->durasi . ' Jam' }}</td>
                                                                    <td>
                                                                        <a href="#"><i
                                                                                class="icon-copy fa fa-pencil"
                                                                                aria-hidden="true" data-toggle="modal"
                                                                                data-target="#Jadwal-editmodal{{ $d['id'] }}"></i></a>
                                                                        <a href="#"><i class="icon-copy fa fa-trash"
                                                                                aria-hidden="true" data-toggle="modal"
                                                                                data-target="#Jadwal-hapusmodal{{ $d['id'] }}"></i>
                                                                        </a>
                                                                        <div class="modal fade"
                                                                            id="Jadwal-hapusmodal{{ $d['id'] }}"
                                                                            tabindex="-1" role="dialog"
                                                                            aria-hidden="true">
                                                                            <div class="modal-dialog modal-dialog-centered"
                                                                                role="document">
                                                                                <div class="modal-content">
                                                                                    <form
                                                                                        action="{{ url('jadwal/delete/' . encrypt($d->id)) }}"
                                                                                        method="GET"
                                                                                        enctype="multipart/form-data">
                                                                                        <div
                                                                                            class="modal-body text-center font-18">
                                                                                            <h4
                                                                                                class="padding-top-30 mb-30 weight-500">
                                                                                                Anda Yakin Ingin Menghapus
                                                                                                Data ini?
                                                                                            </h4>
                                                                                            <div class="padding-bottom-30 row"
                                                                                                style="max-width: 170px; margin: 0 auto">
                                                                                                <div class="col-6">
                                                                                                    <button type="button"
                                                                                                        class="btn btn-secondary border-radius-100 btn-block confirmation-btn"
                                                                                                        data-dismiss="modal">
                                                                                                        <i
                                                                                                            class="fa fa-times"></i>
                                                                                                    </button>
                                                                                                    Tidak
                                                                                                </div>
                                                                                                <div class="col-6">
                                                                                                    <button type="submit"
                                                                                                        class="btn btn-danger border-radius-100 btn-block confirmation-btn">
                                                                                                        <i
                                                                                                            class="fa fa-check"></i>
                                                                                                    </button>
                                                                                                    Ya
                                                                                                </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <!-- Modal Edit Mapel -->
                                                                <div class="modal fade bs-example-modal-lg"
                                                                    data-backdrop="static"
                                                                    id="Jadwal-editmodal{{ $d['id'] }}"
                                                                    tabindex="-1" role="dialog"
                                                                    aria-labelledby="myLargeModalLabel"
                                                                    aria-hidden="true">
                                                                    <div
                                                                        class="modal-dialog modal-lg modal-dialog-centered">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title"
                                                                                    id="myLargeModalLabel">
                                                                                    Form Edit Data Jadwal
                                                                                </h4>
                                                                                <button type="button" class="close"
                                                                                    data-dismiss="modal"
                                                                                    aria-hidden="true">
                                                                                    ×
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body pd-0">
                                                                                <div class="task-list-form">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <form
                                                                                                action="{{ url('jadwal/update/' . encrypt($d->id)) }}"
                                                                                                method="GET"
                                                                                                enctype="multipart/form-data">
                                                                                                @csrf
                                                                                                <input type="hidden"
                                                                                                    value="{{ encrypt($d->id_guru) }}"
                                                                                                    name="id_guru">
                                                                                                @if (count($errors) > 0)
                                                                                                    <div class="alert alert-danger alert-dismissible fade show"
                                                                                                        role="alert">
                                                                                                        <ul>
                                                                                                            <li><strong>Submit
                                                                                                                    Data
                                                                                                                    Gagal
                                                                                                                    !</strong>
                                                                                                            </li>
                                                                                                            @foreach ($errors->all() as $error)
                                                                                                                <li><strong>{{ $error }}</strong>
                                                                                                                </li>
                                                                                                            @endforeach
                                                                                                        </ul>
                                                                                                    </div>
                                                                                                @endif
                                                                                                <div
                                                                                                    class="form-group row">
                                                                                                    <label
                                                                                                        class="col-md-4">Hari</label>
                                                                                                    <div class="col-md-8">
                                                                                                        <select
                                                                                                            class="form-control"
                                                                                                            data-style="btn-outline-primary"
                                                                                                            name="hari">
                                                                                                            <option
                                                                                                                selected="">
                                                                                                                Pilih Hari
                                                                                                            </option>
                                                                                                            @foreach ($dropdown['Hari'] as $hari)
                                                                                                                <option
                                                                                                                    value="{{ $hari->nilai }}"
                                                                                                                    @if ($hari->nilai == $d->hari) selected @endif>
                                                                                                                    {{ $hari->nilai }}
                                                                                                                </option>
                                                                                                            @endforeach
                                                                                                        </select>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="form-group row">
                                                                                                    <label
                                                                                                        class="col-md-4">Jam
                                                                                                        Mulai</label>
                                                                                                    <div class="col-md-8">
                                                                                                        <input
                                                                                                            type="time"
                                                                                                            name="jam_mulai"
                                                                                                            class="form-control"
                                                                                                            value="{{ $d->jam_mulai }}" />

                                                                                                    </div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="form-group row">
                                                                                                    <label
                                                                                                        class="col-md-4">Jam
                                                                                                        Selesai</label>
                                                                                                    <div class="col-md-8">
                                                                                                        <input
                                                                                                            type="time"
                                                                                                            name="jam_selesai"
                                                                                                            class="form-control"
                                                                                                            value="{{ $d->jam_selesai }}" />
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="form-group row">
                                                                                                    <label
                                                                                                        class="col-md-4">Mapel</label>
                                                                                                    <div class="col-md-8">
                                                                                                        <select
                                                                                                            class="form-control"
                                                                                                            data-style="btn-outline-primary"
                                                                                                            name="id_mapel">
                                                                                                            <option
                                                                                                                selected="">
                                                                                                                Pilih Mapel
                                                                                                            </option>
                                                                                                            @foreach ($dropdown['Mapel'] as $mapel)
                                                                                                                <option
                                                                                                                    value="{{ $mapel->id }}"
                                                                                                                    @if (
                                                                                                                        $mapel->nama_mapel . '/' . $mapel->kelas . '-' . $mapel->jurusan ==
                                                                                                                            $d->nama_mapel . '/' . $d->kelas . '-' . $d->jurusan) selected @endif>
                                                                                                                    {{ $mapel->nama_mapel . '/' . $mapel->kelas . '-' . $mapel->jurusan }}
                                                                                                                </option>
                                                                                                            @endforeach
                                                                                                        </select>
                                                                                                    </div>
                                                                                                </div>

                                                                                        </li>

                                                                                    </ul>
                                                                                </div>

                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="submit"
                                                                                    class="btn btn-primary">
                                                                                    Simpan
                                                                                </button>
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-dismiss="modal">
                                                                                    Tutup
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- End Modal Edit Jadwal -->
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                    <!-- Close Task start -->

                                                </div>
                                            </div>
                                        </div>
                                        <!-- Tasks Tab End -->
                                        <!-- Setting Tab start -->
                                        <div class="tab-pane fade height-100-p" id="setting" role="tabpanel">
                                            <div class="profile-setting">
                                                <form action="{{ url('guru/update/' . encrypt($data->id)) }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <ul class="profile-edit-list row">
                                                        <li class="weight-500 col-md-12">
                                                            <h4 class="text-blue h5 mb-20">
                                                                Edit Profile
                                                            </h4>
                                                            <div class="form-group mb-0">
                                                                <label class="col-sm-12 col-md-2 col-form-label">Kode
                                                                    Guru</label>
                                                                <div class="col-sm-12 col-md-10">
                                                                    <input class="form-control" type="text"
                                                                        name="kode_guru"
                                                                        value="{{ $data->kode_guru }}" />
                                                                </div>
                                                            </div>
                                                            <div class="form-group mb-0">
                                                                <label class="col-sm-12 col-md-2 col-form-label">Nama
                                                                    Guru</label>
                                                                <div class="col-sm-12 col-md-10">
                                                                    <input class="form-control" type="text"
                                                                        name="nama_guru"
                                                                        value="{{ $data->nama_guru }}" />
                                                                </div>
                                                            </div>
                                                            <div class="form-group mb-0">
                                                                <label class="col-sm-12 col-md-2 col-form-label">Jenis
                                                                    Kelamin</label>
                                                                <div class="col-sm-12 col-md-10">
                                                                    <select class="custom-select col-12" name="jk">
                                                                        <option selected="">Pilih Jenis</option>
                                                                        @foreach ($dropdown['JK'] as $jk)
                                                                            <option value="{{ $jk->nilai }}"
                                                                                @if ($jk->nilai == $data->jk) selected @endif>
                                                                                {{ $jk->nilai }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group mb-0">
                                                                <label class="col-sm-12 col-md-2 col-form-label">Tanggal
                                                                    Lahir</label>
                                                                <div class="col-sm-12 col-md-10">
                                                                    <input class="form-control" placeholder="Select Date"
                                                                        type="date" name="tgllahir"
                                                                        value="{{ $data->tgllahir }}" />
                                                                </div>
                                                            </div>
                                                            <div class="form-group mb-0">
                                                                <label
                                                                    class="col-sm-12 col-md-2 col-form-label">Jabatan</label>
                                                                <div class="col-sm-12 col-md-10">
                                                                    <select class="custom-select col-12" name="jabatan">
                                                                        <option selected="">Pilih Jabatan</option>
                                                                        @foreach ($dropdown['Jabatan'] as $jabatan)
                                                                            <option value="{{ $jabatan->nilai }}"
                                                                                @if ($jabatan->nilai == $data->jabatan) selected @endif>
                                                                                {{ $jabatan->nilai }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="form-group mb-0">
                                                                <label class="col-sm-12 col-md-2 col-form-label">Upload
                                                                    foto</label>
                                                                <div class="col-sm-12 col-md-10">
                                                                    <input type="file" class="form-control"
                                                                        name="foto">
                                                                </div>
                                                            </div>
                                                            <div class="form-group mb-0">
                                                                <label class="col-sm-12 col-md-2 col-form-label">Nomor
                                                                    Telp</label>
                                                                <div class="col-sm-12 col-md-10">
                                                                    <input class="form-control" type="tel"
                                                                        name="notelp" value="{{ $data->notelp }}" />
                                                                </div>
                                                            </div>
                                                            <div class="form-group mb-0">
                                                                <label
                                                                    class="col-sm-12 col-md-2 col-form-label">Email</label>
                                                                <div class="col-sm-12 col-md-10">
                                                                    <input class="form-control" type="email"
                                                                        name="email" value="{{ $data->email }}" />
                                                                </div>
                                                            </div>

                                                            <div class="form-group mb-0">
                                                                <label
                                                                    class="col-sm-12 col-md-2 col-form-label">Password</label>
                                                                <div class="col-sm-12 col-md-10">
                                                                    <input class="form-control" type="password"
                                                                        name="password" />
                                                                </div>
                                                            </div>
                                                            <div class="form-group mb-2">
                                                                <label
                                                                    class="col-sm-12 col-md-2 col-form-label">Role</label>
                                                                <div class="col-sm-12 col-md-10">
                                                                    <select class="custom-select col-12" name="role">
                                                                        <option selected="">Pilih Role</option>
                                                                        @foreach ($dropdown['Role'] as $role)
                                                                            <option value="{{ $role->nilai }}"
                                                                                @if ($role->nilai == $data->role) selected @endif>
                                                                                {{ $role->nilai }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group mb-0">
                                                                <input type="submit" class="btn btn-primary"
                                                                    value="Update Data" />
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- Setting Tab End -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('layouts._includes._footersection')
        </div>
    </div>
@endsection
