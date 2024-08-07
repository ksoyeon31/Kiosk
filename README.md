# Kiosk
# xampp control shell > mysql -uroot -p > kiosk 데이터베이스 생성 > menu 테이블 생성 

CREATE TABLE menu (
    ->     id VARCHAR(5) PRIMARY KEY,
    ->     name VARCHAR(50) NOT NULL,
    ->     price INT NOT NULL,
    ->     available CHAR(1) NOT NULL DEFAULT 'o',
    ->     category VARCHAR(50) NOT NULL,
    ->     image_url VARCHAR(255) NOT NULL,
    ->     quantity INT NOT NULL
    -> ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

INSERT INTO menu (id, name, price, available, category, image_url, quantity) VALUES
    -> ('c1', '에스프레소', 1200, 'o', 'COFFEE', 'http://www.caffebene.co.kr/uploads/product/20200607365216.png', 10),
    -> ('c2', '아메리카노', 1500, 'o', 'COFFEE', 'http://www.caffebene.co.kr/uploads/product/20200607445430.png', 10),
    -> ('c3', '헤이즐럿 아메리카노', 1800, 'o', 'COFFEE', 'http://www.caffebene.co.kr/uploads/product/20200607445430.png', 10),
    -> ('c4', '바닐라 라떼', 2500, 'o', 'COFFEE', 'http://www.caffebene.co.kr/uploads/product/20200607111992.png', 10),
    -> ('c5', '카페라떼', 2200, 'o', 'COFFEE', 'http://www.caffebene.co.kr/uploads/product/20200607111992.png', 10),
    -> ('c6', '카라멜 마끼야또', 2800, 'o', 'COFFEE', 'http://www.caffebene.co.kr/uploads/product/20200607498136.png', 10),
    -> ('c7', '카페모카', 2800, 'o', 'COFFEE', 'http://www.caffebene.co.kr/uploads/product/20200607822666.png', 10),
    -> ('c8', '헤이즐럿 라떼', 2500, 'o', 'COFFEE', 'http://www.caffebene.co.kr/uploads/product/20200607111992.png', 10),
    -> ('c9', '고구마라떼', 2700, 'o', 'LATTE', 'http://www.caffebene.co.kr/uploads/product/20200607111383.png', 10),
    -> ('c10', '그린티라떼', 2700, 'o', 'LATTE', 'http://www.caffebene.co.kr/uploads/product/20200610893497.png', 10),
    -> ('c11', '오곡라떼', 2700, 'o', 'LATTE', 'http://www.caffebene.co.kr/uploads/product/20200607935102.png', 10),
    -> ('c12', '초코라떼', 2700, 'o', 'LATTE', 'http://www.caffebene.co.kr/uploads/product/20220304243069.png', 10),
    -> ('c13', '자스민', 1500, 'o', 'HERB TEA', 'http://www.caffebene.co.kr/uploads/product/20220315400366.png', 10),
    -> ('c14', '페퍼민트', 1500, 'o', 'HERB TEA', 'http://www.caffebene.co.kr/uploads/product/20200610288582.png', 10),
    -> ('c15', '캐모마일', 1500, 'o', 'HERB TEA', 'http://www.caffebene.co.kr/uploads/product/20220315400366.png', 10),
    -> ('c16', '히비스커스', 1500, 'o', 'HERB TEA', 'http://www.caffebene.co.kr/uploads/product/20201119887500.png', 10),
    -> ('c17', '레몬그라스', 1500, 'o', 'HERB TEA', 'http://www.caffebene.co.kr/uploads/product/20201119432583.png', 10),
    -> ('c18', '유자티', 2000, 'o', 'FRUIT TEA', 'http://www.caffebene.co.kr/uploads/product/20200610603726.png', 10),
    -> ('c19', '자몽티', 2000, 'o', 'FRUIT TEA', 'http://www.caffebene.co.kr/uploads/product/20200610719777.png', 10),
    -> ('c20', '레몬티', 2000, 'o', 'FRUIT TEA', 'http://www.caffebene.co.kr/uploads/product/20201119432583.png', 10),
    -> ('c21', '복숭아 아이스티', 2500, 'o', 'FRUIT TEA', 'http://www.caffebene.co.kr/uploads/product/20200610794548.png', 10),
    -> ('c22', '자몽에이드', 2300, 'o', 'ADE', 'http://www.caffebene.co.kr/uploads/product/20200614270060.png', 10),
    -> ('c23', '레몬에이드', 2300, 'o', 'ADE', 'http://www.caffebene.co.kr/uploads/product/20200614802613.png', 10),
    -> ('c24', '청포도 에이드', 2800, 'o', 'ADE', 'http://www.caffebene.co.kr/uploads/product/20200614391379.png', 10),
    -> ('c25', '오아이스', 3000, 'o', 'ADE', 'http://www.caffebene.co.kr/uploads/product/20210830249276.png', 10),
    -> ('c26', '쿠키앤크림 프라페', 3500, 'o', 'FRAPPE', 'http://www.caffebene.co.kr/uploads/product/20220831726772.png', 10),
    -> ('c27', '자바칩 프라페', 3500, 'o', 'FRAPPE', 'http://www.caffebene.co.kr/uploads/product/20200614892628.png', 10),
    -> ('c28', '그린티민트 초코프라페', 3500, 'o', 'FRAPPE', 'http://www.caffebene.co.kr/uploads/product/20200610414609.png', 10),
    -> ('c29', '요거트', 3500, 'o', 'SMOOTHIE', 'http://www.caffebene.co.kr/uploads/product/20200610189199.png', 10),
    -> ('c30', '블루베리', 3500, 'o', 'SMOOTHIE', 'http://www.caffebene.co.kr/uploads/product/20220315689828.png', 10),
    -> ('c31', '청포도', 3500, 'o', 'SMOOTHIE', 'http://www.caffebene.co.kr/uploads/product/20200610228043.png', 10),
    -> ('c32', '망고', 3500, 'o', 'SMOOTHIE', 'http://www.caffebene.co.kr/uploads/product/20200617511281.png', 10),
    -> ('c33', '딸기', 3500, 'o', 'SMOOTHIE', 'http://www.caffebene.co.kr/uploads/product/20220315204095.png', 10),
    -> ('c34', '마카롱', 1800, 'o', 'DESSERT', 'http://www.caffebene.co.kr/uploads/product/20220520391961.png', 10),
    -> ('c35', '빵', 2000, 'o', 'DESSERT', 'http://www.caffebene.co.kr/uploads/product/20230111235431.png', 10),
    -> ('c36', '쿠키', 1500, 'o', 'DESSERT', 'http://www.caffebene.co.kr/uploads/product/20200614441796.png', 10),
    -> ('c37', '에그타르트', 2000, 'o', 'DESSERT', 'http://www.caffebene.co.kr/uploads/product/20211020541897.png', 10);


![image](https://github.com/user-attachments/assets/14d3632b-0d91-480c-9669-03b4fdab48a3)

Xampp Control Panel에서 Apache, MYSQL Start 

http://localhost/ByuRiCoffee/Start.html 실행
