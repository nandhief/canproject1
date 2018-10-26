# BPR MAA API docs

## Initials
base_url `http://103.82.242.173/maa/api`

Authentication header `Authorization: Bearer adm05cfqhYPduh4VbBLrg84icCytIQ9qcybat1PG7asHI5Xf4VQnawnNPHAf`

## Login
`/login`

required `username` dan `password`, response `token` seperti `adm05cfqhYPduh4VbBLrg84icCytIQ9qcybat1PG7asHI5Xf4VQnawnNPHAf`

## Register
`/register`

required `name`, `email`, `phone`, `password`

## Reset Password
`/forgot`

required `email`

## Dashboard
`/dashboard`

Mencakup highlight Lelang, Promo, News. Untuk Slide belum selesai.

## Lelang
Untuk list lelang
`/lelang`

Untuk detail lelang
`lelang/{id}`

## Promo
Untuk list promo
`/promo`

Untuk detail promo
`promo/{id}`

## News
Untuk list news
`/news`

Untuk detail news
`/news/{id}`

## Career
`/career`

Required `name`, `email`, `phone`, `posisi`, `description`, `path_resume` (Upload File Resume Pelamar)

