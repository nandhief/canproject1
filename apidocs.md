# BPR MAA API docs

## Email BPRMAA
email: `bprmaamobile@gmail.com`

password: `@bprmaamobile1`

## Initials
header request `Accept: application/json; X-Request-With: XMLHttpRequest`

Authentication header `Authorization: Bearer adm05cfqhYPduh4VbBLrg84icCytIQ9qcybat1PG7asHI5Xf4VQnawnNPHAf`

## Login
`http://103.82.242.173/maa/api/login`

required `username` dan `password`, response `token` seperti `adm05cfqhYPduh4VbBLrg84icCytIQ9qcybat1PG7asHI5Xf4VQnawnNPHAf`

## Register
`http://103.82.242.173/maa/api/register`

required `name`, `email`, `phone`, `password`

## Reset Password
`http://103.82.242.173/maa/api/forgot`

required `email`

## Update User
`http://103.82.242.173/maa/api/user/update`

## Update Password User
`http://103.82.242.173/maa/api/user/password`

## Dashboard
`http://103.82.242.173/maa/api/dashboard`

Mencakup highlight Promo, News, dan Slider

## Lelang
Untuk list lelang
`http://103.82.242.173/maa/api/lelang`

Untuk detail lelang
`http://103.82.242.173/maa/api/lelang/{id}`

## Promo
Untuk list promo
`http://103.82.242.173/maa/api/promo`

Untuk detail promo
`http://103.82.242.173/maa/api/promo/{id}`

## News
Untuk list news
`http://103.82.242.173/maa/api/news`

Untuk detail news
`http://103.82.242.173/maa/api/news/{id}`

## Career
`http://103.82.242.173/maa/api/career`

Required `name`, `email`, `phone`, `posisi`, `description`, `path_resume` (Upload File Resume Pelamar)

## Lowongan
Untuk list lowongan `http://103.82.242.173/maa/api/vacancy`

Untuk detail lowongan `http://103.82.242.173/maa/api/vacancy/{id}`

## Pengajuan Kredit & Tabungan
Kredit: `http://103.82.242.173/maa/api/credit`

Tabungan: `http://103.82.242.173/maa/api/tabungan`

Required `name`, `email`, `phone`, `address`, `foto_ktp`