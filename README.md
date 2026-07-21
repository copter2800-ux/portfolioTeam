# Operator Dashboard — คู่มือการใช้งาน

เว็บไซต์แดชบอร์ดสไตล์แฮ็กเกอร์ (โทนเทา-ขาว) เขียนด้วย PHP + HTML
หน้าแรกแสดงการ์ดผู้ปฏิบัติงาน 4 คน กดเข้าไปแต่ละคนจะเห็นรูปผลงาน (case files)
พร้อมคำอธิบาย โดยดึงรูปภาพจาก GitHub

## โครงสร้างไฟล์

```
hacker-portfolio/
├── index.php        หน้าแดชบอร์ดหลัก (แสดงการ์ด 4 คน)
├── profile.php       หน้าโปรไฟล์รายบุคคล (?id=1 ถึง 4)
├── config.php         ★ แก้ข้อมูลทั้งหมดที่ไฟล์นี้ที่เดียว
└── assets/
    └── style.css      ธีมแฮ็กเกอร์เทา-ขาว (terminal style)
```

## วิธีรันทดสอบบนเครื่อง (ต้องมี PHP)

```bash
cd hacker-portfolio
php -S 127.0.0.1:8000
```
แล้วเปิดเบราว์เซอร์ไปที่ `http://127.0.0.1:8000/index.php`

## วิธีเชื่อมรูปภาพจาก GitHub

ในไฟล์ `config.php` ด้านบนสุดมีค่าคงที่:

```php
define('GH_USER', 'your-github-username');
define('GH_REPO', 'portfolio-assets');
define('GH_BRANCH', 'main');
```

แก้เป็นชื่อ GitHub และ repo จริงของคุณ (repo ต้องเป็น public หรือใช้ CDN
เช่น jsDelivr ถ้าต้องการความเร็วขึ้น) ระบบจะสร้าง URL รูปแบบ:

```
https://raw.githubusercontent.com/<user>/<repo>/<branch>/avatars/operator1.png
```

โครงสร้างโฟลเดอร์ที่แนะนำใน repo GitHub ของคุณ:

```
portfolio-assets/
├── avatars/
│   ├── operator1.png
│   ├── operator2.png
│   ├── operator3.png
│   └── operator4.png
└── projects/
    ├── operator1_case1.png
    ├── operator1_case2.png
    ├── operator1_case3.png
    └── ... (ทำนองเดียวกันสำหรับ operator2-4)
```

หากไม่อยากใช้ helper `gh_img()` สามารถวาง URL เต็มลงใน `avatar` หรือ
`image` โดยตรงก็ได้ เช่น:

```php
'avatar' => 'https://raw.githubusercontent.com/john/assets/main/me.jpg',
```

## วิธีแก้ข้อมูลแต่ละคน

เปิด `config.php` แล้วแก้ในอาร์เรย์ `$OPERATORS` แต่ละ key (1-4) มีฟิลด์:

| ฟิลด์        | ความหมาย                              |
|--------------|-----------------------------------------|
| codename     | ชื่อรหัส/นามแฝงที่แสดงเด่นบนการ์ด        |
| realname     | ชื่อ-นามสกุลจริง                        |
| role         | บทบาท เช่น Red Team / Blue Team          |
| specialty    | ความเชี่ยวชาญเฉพาะทาง                    |
| avatar       | URL รูปโปรไฟล์ (จาก GitHub)              |
| bio          | คำอธิบายสั้น ๆ                          |
| portfolio    | อาร์เรย์ผลงาน แต่ละชิ้นมี image/title/desc |

ถ้าต้องการเพิ่ม/ลดจำนวนคนจาก 4 คน สามารถเพิ่ม key ใหม่ (เช่น 5, 6) หรือ
ลบ key ออกได้เลย หน้าแดชบอร์ดจะวนลูปแสดงตามจำนวนจริงในอาร์เรย์อัตโนมัติ

## หมายเหตุด้านความปลอดภัย (เนื่องจากผู้ใช้เน้นสาย pentest)

- ทุกค่าที่พิมพ์ออกหน้าเว็บผ่าน `htmlspecialchars()` แล้ว เพื่อป้องกัน XSS
  จากข้อมูลใน config
- พารามิเตอร์ `id` ใน URL ถูก cast เป็น `(int)` ก่อนใช้งาน ป้องกัน SQL/Path
  injection แม้ตอนนี้ยังไม่ได้ต่อฐานข้อมูลก็ตาม
- หากในอนาคตจะเชื่อมฐานข้อมูลจริง ให้ใช้ Prepared Statement (PDO) เสมอ
  และอย่านำค่าจาก `$_GET`/`$_POST` ไปต่อ query string ตรง ๆ
