@component('mail::message')
    <img style="height: auto;
        width: 40%; display: block;
      margin: 0 auto;"
        src="https://study.indonesiapowerkmj.com/assets_ip2022/img/logo.png" alt="" />
    <br>
    <br>
    @if ($details['jenis'] == 'diterima')
        <h3>SELAMAT!</h3>
    @else
        <h3>MAAF!</h3>
    @endif
    <p>Berdasarkan hasil evaluasi pengajuan dan ketersediaan kuota maka kami informasikan bahwa pengajuan atas :</p>
    <p>Nama : {{ $details['nama'] }}</p>
    <p>Instansi Pendidikan : {{ $details['instansi'] }}</p>
    <br />
    @if ($details['jenis'] == 'diterima')
        <p>Dinyatakan <span style="font-weight:bold">disetujui</span>pengajuannya untuk mengikuti program Praktek Kerja
            Lapangan (PKL) di PT PLN Indonesia Power UBP Kamojang. Informasi mengenai bidang kerja dan penempatan dapat
            dilihat pada
            pengumuman di akun resmi media sosial perusahaan dan segera lakukan konfirmasi kepada penanggungjawab terkait.
        </p>
    @else
        <p>
            Dinyatakan <span style="font-weight:bold">belum disetujui</span> pengajuannya untuk mengikuti program Praktek
            Kerja Lapangan (PKL) di PT PLN Indonesia Power UBP Kamojang. Jangan patah semangat, Anda masih berkesempatan
            untuk dapat mengajukan di periode selanjutnya. Informasi pendaftaran dapat di pantau melalui akun resmi media
            sosial perusahaan.
        </p>
    @endif
    <br>
    <br>
    UBP Kamojang
    @endcomponent
    @component('mail::footer')
        © 2024 PT Indonesia Power Kamojang POMU. All rights reserved
    @endcomponent

