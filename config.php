<?php
/**
 * config.php
 * -----------------------------------------------------------------
 * แก้ไขข้อมูลทีมและลิงก์รูปภาพผลงานได้ที่ไฟล์นี้ที่เดียว
 * รูปภาพดึงจากโฟลเดอร์ "img/" ในเว็บนี้เอง
 * แค่เอาไฟล์รูปไปวางไว้ในโฟลเดอร์ img/ ที่อยู่ระดับเดียวกับ index.php
 *
 * โครงสร้างของแต่ละ Team Project:
 *   image     : path รูปภาพ
 *   title     : ชื่อผลงาน
 *   desc      : คำอธิบายโดยย่อ
 *   status    : สถานะโครงการ  ("Completed" | "In Progress" | "Prototype")
 *   summary   : สรุปผลงาน (แสดงบน Popup)
 *   use_cases : ประโยชน์ / การนำไปใช้งาน (array)
 *   skills    : เทคโนโลยีและสกิลที่ใช้ (array)
 *   features  : จุดเด่นของผลงาน (array)
 *   future    : ความเป็นไปได้ในการต่อยอด (array)
 * -----------------------------------------------------------------
 */

// โฟลเดอร์เก็บรูปภาพ (relative path จากตำแหน่งของ index.php / profile.php)
define('IMG_DIR', 'img');

function gh_img(string $path): string {
    return IMG_DIR . '/' . ltrim($path, '/');
}

$TEAM_PORTFOLIO = [
    [
        "image"     => gh_img("Tofyy888_MJ_499ddc5852.png"),
        "title"     => "DropCTF x Permis Security — Beginner Red Team Assessment",
        "desc"      => "การจำลองการโจมตีเต็มรูปแบบเพื่อประเมินความแข็งแรงของระบบป้องกันทั้งองค์กร",
        "status"    => "Completed",
        "summary"   => "",
        "use_cases" => [
            "เข้าใจขั้นตอนการประเมินความปลอดภัยขององค์กร",
            "พัฒนาทักษะการคิดเชิงวิเคราะห์และการแก้ปัญหา",
            "สามารถประยุกต์ใช้ในการทำ Security Assessment และ Penetration Testing",
        ],
        "skills"    => ["Nmap", "Metasploit", "BloodHound", "Active Directory", "C2 Framework", "Privilege Escalation"],
        "features"  => [
            "จำลองกระบวนการ Red Team ตั้งแต่ Reconnaissance จนถึงการประเมินเป้าหมาย",
            "วิเคราะห์ช่องโหว่และจัดลำดับความเสี่ยงตามผลกระทบ",
            "สร้าง Attack Path เพื่ออธิบายเส้นทางการโจมตีอย่างเป็นระบบ",
        ],
        "future"    => [
            "ศึกษา Active Directory Security ในระดับลึก",
            "พัฒนาทักษะด้าน Windows Security และ Privilege Escalation",
        ],
    ],
    [
        "image"     => gh_img("CC.png"),
        "title"     => "เหรียญทอง รองชนะเลิศอันดับ 1 — การแข่งขันสร้าง Web Applications ม.4-ม.6",
        "desc"      => "รางวัลเหรียญทอง รองชนะเลิศอันดับที่ 1 กิจกรรมการแข่งขันการสร้าง Web Applications ระดับชั้น ม.4-ม.6
                        งานศิลปหัตถกรรมนักเรียน ระดับเขตพื้นที่การศึกษา ครั้งที่ 31 ปีการศึกษา 2566 \"ศาสตร์ศิลป์ วิชาการ สืบสานสร้างสุพรรณบุรี\"
                        จัดโดยสำนักงานเขตพื้นที่การศึกษามัธยมศึกษาสุพรรณบุรี ณ โรงเรียนอู่ทอง ระหว่างวันที่ 13-21 มกราคม 2567 ผลงานจากการทำงานร่วมกันเป็นทีม",
        "status"    => "Completed",
        "summary"   => "",
        "use_cases" => [
            "เพิ่มพูนทักษะการพัฒนาเว็บไซต์ทั้งด้าน Front-end และ Back-end",
            "เข้าใจขั้นตอนการออกแบบ พัฒนา และทดสอบ Web Application ภายใต้เวลาแข่งขันจำกัด",
            "สามารถประยุกต์ใช้ความรู้ในการสร้างเว็บไซต์และระบบงานจริง",
        ],
        "skills"    => ["HTML5", "CSS3", "JavaScript", "Responsive Web Design", "UI/UX Design", "Problem Solving", "Web Development", "Teamwork"],
        "features"  => [
            "แข่งขันออกแบบและพัฒนา Web Application ภายในเวลาที่กำหนดของการแข่งขัน",
            "ได้รับรางวัลเหรียญทอง รองชนะเลิศอันดับที่ 1 ระดับเขตพื้นที่การศึกษา",
            "ฝึกการทำงานร่วมกันเป็นทีมภายใต้ข้อกำหนดและกติกาการแข่งขัน",
        ],
        "future"    => [
            "พัฒนาเว็บไซต์ให้รองรับการใช้งานจริงและมีประสิทธิภาพมากยิ่งขึ้น",
            "นำประสบการณ์จากการแข่งขันไปต่อยอดในการแข่งขันและโครงงานด้านเทคโนโลยีสารสนเทศในระดับที่สูงขึ้น",
        ],
    ],
    [
        "image"     => gh_img("TT.png"),
        "title"     => "เหรียญทองแดง — STEM & Microcontroller Project (46ict AI for a New Future)",
        "desc"      => "รางวัลเหรียญทองแดง กิจกรรมการแข่งขันโครงงานสะเต็มศึกษาและกล่องสมองกล (STEM & Microcontroller Project) นำเสนอภาษาไทย ระดับชั้น ม.4-6
                        ในงานการแข่งขันมหกรรมวิชาการ \"46ict พัฒนาชีวิต ด้วยปัญญาประดิษฐ์ สู่โลกอนาคตใหม่ (Advancing Lives with AI for a New Future)\"
                        จัดโดยกลุ่มโรงเรียนผู้นำ 46ict และเครือข่าย ระหว่างวันที่ 23-25 สิงหาคม 2567 ณ จังหวัดภูเก็ต ผลงานจากการทำงานร่วมกันเป็นทีม",
        "status"    => "Completed",
        "summary"   => "",
        "use_cases" => [
            "สามารถประยุกต์ใช้ AI ร่วมกับ Microcontroller ในการพัฒนาโครงงานด้านการศึกษาและนวัตกรรม",
            "ต่อยอดความรู้สู่การพัฒนา IoT และ Smart Device",
            "เป็นพื้นฐานสำหรับการศึกษาด้าน AI และวิศวกรรมคอมพิวเตอร์ในอนาคต",
        ],
        "skills"    => ["Artificial Intelligence (AI)", "STEM Education", "Microcontroller", "Problem Solving", "Teamwork", "Design Thinking", "Presentation Skills", "Basic Programming"],
        "features"  => [
            "แข่งขันโครงงานสะเต็มศึกษาและกล่องสมองกล พร้อมนำเสนอผลงานเป็นภาษาไทย",
            "ประยุกต์ใช้ Artificial Intelligence ร่วมกับ Microcontroller ในโครงงาน",
            "ได้รับรางวัลเหรียญทองแดงระดับมหกรรมวิชาการ 46ict",
        ],
        "future"    => [
            "ศึกษา Machine Learning และ Deep Learning เพิ่มเติม",
            "นำความรู้ไปประยุกต์ใช้ในการแข่งขันและการสร้างนวัตกรรมครั้งต่อไป",
        ],
    ],
    [
        "image"     => gh_img("Screenshot 2026-07-21 142541.png"),
        "title"     => "เหรียญเงิน — การแข่งขันหุ่นยนต์ระดับสูง ม.4-ม.6",
        "desc"      => "รางวัลเหรียญเงิน กิจกรรมการแข่งขันหุ่นยนต์ระดับสูง ระดับชั้น ม.4-ม.6 งานศิลปหัตถกรรมนักเรียนระดับเขตพื้นที่การศึกษา ครั้งที่ 72 ปีการศึกษา 2567
                        จัดโดยสำนักงานเขตพื้นที่การศึกษามัธยมศึกษานนทบุรี ระหว่างวันที่ 14-19 มกราคม 2568 ผลงานจากการทำงานร่วมกันเป็นทีมในการออกแบบและควบคุมหุ่นยนต์",
        "status"    => "Completed",
        "summary"   => "",
        "use_cases" => [
            "เข้าใจหลักการออกแบบและควบคุมหุ่นยนต์ระดับสูงในสถานการณ์แข่งขันจริง",
            "ฝึกการวางแผนกลยุทธ์และแก้ปัญหาเฉพาะหน้าร่วมกับเพื่อนร่วมทีม",
            "ต่อยอดสู่การศึกษาด้าน Robotics และ Embedded Systems",
        ],
        "skills"    => ["Robotics", "Embedded Systems", "Microcontroller Programming", "Circuit Design", "Problem Solving", "Teamwork"],
        "features"  => [
            "แข่งขันควบคุมและปรับแต่งหุ่นยนต์ระดับสูงภายใต้กติกาที่กำหนด",
            "ได้รับรางวัลเหรียญเงินระดับเขตพื้นที่การศึกษา",
            "ทำงานร่วมกับทีมตั้งแต่ขั้นตอนออกแบบจนถึงวันแข่งขันจริง",
        ],
        "future"    => [
            "พัฒนาโครงสร้างและระบบควบคุมหุ่นยนต์ให้แม่นยำและเสถียรยิ่งขึ้น",
            "ต่อยอดสู่การแข่งขันหุ่นยนต์ระดับภาคและระดับประเทศ",
        ],
    ],
    [
        "image"     => gh_img("Screenshot 2026-07-21 142504.png"),
        "title"     => "Hack The Scammer CTF 2025",
        "desc"      => "ใบประกาศนียบัตรจากสำนักงานคณะกรรมการการรักษาความมั่นคงปลอดภัยไซเบอร์แห่งชาติ (NCSA) และกระทรวงดิจิทัลเพื่อเศรษฐกิจและสังคม
                        สำหรับการเข้าร่วมกิจกรรมการแข่งขัน \"Hack The Scammer CTF 2025\" รูปแบบออนไลน์ เมื่อวันที่ 13 ธันวาคม 2568",
        "status"    => "Completed",
        "summary"   => "",
        "use_cases" => [
            "เข้าใจรูปแบบกลโกงและเทคนิคของมิจฉาชีพออนไลน์ (Scam) ในมุมมองด้านความปลอดภัยไซเบอร์",
            "ฝึกทักษะการวิเคราะห์และสืบสวนภัยคุกคามผ่านโจทย์ CTF",
            "เสริมความตระหนักรู้ด้าน Cyber Security ให้กับสังคม",
        ],
        "skills"    => ["CTF", "Digital Forensics", "OSINT", "Threat Analysis", "Problem Solving"],
        "features"  => [
            "แข่งขัน Capture The Flag ในหัวข้อการรับมือมิจฉาชีพออนไลน์",
            "จัดโดยหน่วยงานภาครัฐด้านความมั่นคงปลอดภัยไซเบอร์ระดับประเทศ (NCSA)",
            "แข่งขันรูปแบบออนไลน์ ใช้ทักษะสืบสวนและวิเคราะห์ภัยคุกคามจริง",
        ],
        "future"    => [
            "ต่อยอดสู่การแข่งขัน CTF ระดับที่สูงขึ้นในสายงาน Threat Intelligence",
            "เผยแพร่ความรู้เรื่องกลโกงออนไลน์เพื่อป้องกันภัยให้ชุมชน",
        ],
    ],
    [
        "image"     => gh_img("Screenshot 2026-07-21 142527.png"),
        "title"     => "Thailand Cyber Talent 2025 — Certificate of Appreciation",
        "desc"      => "Certificate of Appreciation จากสำนักงานคณะกรรมการการรักษาความมั่นคงปลอดภัยไซเบอร์แห่งชาติ (NCSA) ร่วมกับ Huawei และ Thailand National Cyber Academy (THNCA)
                        มอบให้แก่ นันท์อนณ ตั้งใจพอเพียง ในนามทีม Toffy888 จากโรงเรียนราชวินิต นนทบุรี สำหรับการเข้าร่วมโครงการ \"Thailand Cyber Talent 2025\" มอบให้เมื่อวันที่ 30 สิงหาคม 2568",
        "status"    => "Completed",
        "summary"   => "",
        "use_cases" => [
            "เข้าร่วมโครงการค้นหาและบ่มเพาะบุคลากรด้าน Cyber Security ระดับประเทศ",
            "ได้รับความรู้และประสบการณ์ตรงจากหน่วยงานความมั่นคงปลอดภัยไซเบอร์และพันธมิตรระดับโลก",
            "สร้างเครือข่ายกับผู้สนใจด้าน Cyber Security ทั่วประเทศ",
        ],
        "skills"    => ["Cyber Security Awareness", "Networking", "Teamwork", "Digital Literacy"],
        "features"  => [
            "ได้รับคัดเลือกเข้าร่วมโครงการ Thailand Cyber Talent 2025",
            "จัดโดย NCSA ร่วมกับ Huawei และ THNCA",
            "เข้าร่วมในนามทีม Toffy888",
        ],
        "future"    => [
            "ต่อยอดสู่เส้นทางสายอาชีพด้าน Cyber Security ในระดับประเทศ",
            "เข้าร่วมโครงการบ่มเพาะบุคลากรไซเบอร์รุ่นต่อไป",
        ],
    ],
];

$OPERATORS = [
    1 => [
        'id'        => 1,
        'codename'  => 'GHOST_0x1',
        'realname'  => 'Thanapol Kakee',
        'role'      => 'frontend',
        'specialty' => 'UX/UI Design / Frontend Development',
        'avatar'    => gh_img('copter1.jpg'),
        'bio'       => 'Frontend Developer ที่เชี่ยวชาญในการพัฒนา Modern Web Interface โดยผสาน UX/UI, Performance และ Responsive Design 
                        เพื่อสร้างเว็บแอปพลิเคชันที่มีประสิทธิภาพ ใช้งานง่าย และพร้อมต่อยอดในอนาคต',
        'portfolio' => [
            [
                'image' => gh_img('copter.png'),
                'title' => 'Advanced Prompt Engineering',
                'desc'  => 'ใบประกาศนียบัตรจาก Vanderbilt University ผ่าน Coursera รับรองการสำเร็จหลักสูตรด้าน Prompt Engineering ขั้นสูง เน้นการออกแบบและปรับปรุง 
                Prompt เพื่อใช้งาน AI ได้อย่างมีประสิทธิภาพ ครอบคลุมเทคนิคการสื่อสารกับ AI, การกำหนด Context, การสร้างคำสั่งที่แม่นยำ และการประยุกต์ใช้ AI ในการทำงานจริง',
            ],
          
        ],
    ],
    2 => [
        'id'        => 2,
        'codename'  => 'CIPHER_0x2',
        'realname'  => 'Thanayot Tantikulphakdee',
        'role'      => 'business',
        'specialty' => ' Business Systems',
        'avatar'    => gh_img('Screenshot 2026-07-22 005954.png'),
        'bio'       => 'ผมสนใจการพัฒนาระบบที่ช่วยแก้ปัญหาทางธุรกิจ ผ่านการวิเคราะห์ความต้องการ 
                        ออกแบบ Workflow และสร้าง Digital Solutions ที่ช่วยเพิ่มประสิทธิภาพการทำงาน พร้อมเชื่อมโยงเทคโนโลยีเข้ากับเป้าหมายขององค์กร',
        'portfolio' => [
            [
                'image' => gh_img('748763393_1712133896679827_4761648262696059640_n.jpg'),
                'title' => 'เกียรติบัตรผ่านการอบรมหลักสูตร English Communication for Work and Business',
                'desc'  => 'เกียรติบัตรฉบับนี้มอบให้แก่ผู้ที่ผ่านการอบรมและผ่านเกณฑ์การประเมินผลในหลักสูตร English Communication for Work and Business ซึ่งมุ่งพัฒนาทักษะการสื่อสารภาษาอังกฤษสำหรับการทำงาน การติดต่อสื่อสารในองค์กร และการดำเนินธุรกิจ เพื่อเพิ่มศักยภาพด้านภาษาอังกฤษและเสริมความพร้อมในการทำงานในยุคดิจิทัล 
                            โดยจัดอบรมโดย Tockto Company Limited ภายใต้โครงการ English Speaking for the New Workforce และได้รับการสนับสนุนจาก สำนักงานส่งเสริมเศรษฐกิจดิจิทัล (depa)',
            ],
            
        ],
    ],
    3 => [
        'id'        => 3,
        'codename'  => 'PHANTOM_0x3',
        'realname'  => 'Weeraphat Jaisiri',
        'role'      => 'Qa Manager',
        'specialty' => 'QA Manager / QA Lead / Test Manager',
        'avatar'    => gh_img('753983784_1573137734327241_4938924203356621746_n.jpg'),
        'bio'       => 'QA Manager / QA Lead / Test Manager เชี่ยวชาญผสมผสานระหว่างทักษะการบริหารจัดการธุรกิจ 
                        (Business Management) และการวิเคราะห์/ทดสอบระบบ (System Testing & QA) มีความสามารถในการวิเคราะห์กระบวนการทำงาน ประสานงานระหว่างทีมธุรกิจและทีมพัฒนาเทคโนโลยี',
        'portfolio' => [
            [
                'image' => gh_img('JJ.png'),
                'title' => 'ใบประกาศนียบัตรจาก Vanderbilt University ผ่าน Coursera รับรองการสำเร็จหลักสูตรด้าน Prompt Engineering ขั้นสูง',
                'desc'  => 'ใบประกาศนียบัตรจาก Vanderbilt University ผ่าน Coursera รับรองการสำเร็จหลักสูตรด้าน Prompt Engineering ขั้นสูง เน้นการออกแบบและปรับปรุง Prompt เพื่อใช้งาน AI ได้อย่างมีประสิทธิภาพ 
                            ครอบคลุมเทคนิคการสื่อสารกับ AI, การกำหนด Context, การสร้างคำสั่งที่แม่นยำ และการประยุกต์ใช้ AI ในการทำงานจริง',
            ],
           
        ],
    ],
    4 => [
        'id'        => 4,
        'codename'  => 'VOID_0x4',
        'realname'  => 'Nunanon Tungjaiporpeang',
        'role'      => 'Backend Developer ',
        'specialty' => 'backend: Database / API Engineering',
        'avatar'    => gh_img('Screenshot 2026-07-22 004720.png'),
        'bio'       => 'Backend Developer ที่เชี่ยวชาญในการออกแบบ API, Database และ System Architecture 
                        สำหรับ Modern Web Application พร้อมพัฒนา Business Logic ที่รองรับการทำงานของระบบได้อย่างมีประสิทธิภาพ ปลอดภัย และสามารถขยายต่อได้ในอนาคต',
        'portfolio' => [
            [
                'image' => gh_img('arcHA888.png'),
                'title' => 'ArchaCTF: New Year 2026 Challenges',
                'desc'  => 'ใบประกาศนียบัตรจาก DropCTF สำหรับการเข้าร่วมการแข่งขัน ArchaCTF Challenge รุ่น The New Year 2026 Challenges',
            ],
            
           
        ],
    ],
];