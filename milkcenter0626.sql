create database milkcenter;
use milkcenter;
create table updateUser(
	updateUserId int primary key,
	updateUser varchar(50)
);

insert into updateUser values(2001,'織田信長');
insert into updateUser values(2002,'豊臣秀吉');
insert into updateUser values(2003,'徳川家康');

select * from updateUser;

CREATE table category(
	categoryId int primary key,
	category varchar(20)
);
insert into category values(8001,'牛乳');
insert into category values(8002,'バター');
insert into category values(8003,'ヨーグルト');

select * from category;

CREATE table product(
	productId int primary key,
	categoryId int,
	productName varchar(50),
	productPrice decimal,
	src varchar(200),
	comment varchar(1000),
	foreign key(categoryId) references category(categoryId)
);

insert into product values(1001,8001,'みつ葉牛乳',200,'images/milk.png','おいしさ」も「栄養」も両方あきらめない。ワンランク上のカルシウム強化乳飲料。コップ2杯で1日分のカルシウムとビタミンD、牛乳の約2倍のMBP®をおいしく摂取できます。');
insert into product values(1002,8001,'がっつり濃厚5.2',420,'images/milk.png','おいしさ」も「栄養」も両方あきらめない。ワンランク上のカルシウム強化乳飲料。コップ2杯で1日分のカルシウムとビタミンD、牛乳の約2倍のMBP®をおいしく摂取できます。');
insert into product values(1003,8002,'みつ葉バター',1150,'images/butter.png','おいしさ」も「栄養」も両方あきらめない。ワンランク上のカルシウム強化乳飲料。コップ2杯で1日分のカルシウムとビタミンD、牛乳の約2倍のMBP®をおいしく摂取できます。');

select * from product;


CREATE table master(
	id int primary key auto_increment,
	productId int,
	updateDate date,
	updateUserId int,
	stockQuantity int,
	expiryDate date,
	foreign key (productId) references product(productId),
	foreign key (updateUserId) references updateUser(updateUserId)
);



insert into master values(1,1001,'2021-09-15',2001,30,'2021-10-01');
insert into master values(2,1002,'2021-09-15',2001,15,'2021-10-08');
insert into master values(3,1003,'2021-09-15',2001,10,'2021-10-01');

select * from master;

select
	id,
	productId as '製品ID',
	category.category as 'カテゴリ',
	product.productName as '商品名',
	product.productPrice as '価格',
	updateDate as '商品追加日',
	updateUser.updateUser as '追加したユーザ',
	stockQuantity as '在庫',
	expiryDate as '賞味期限',
	product.comment as 'コメント'
from master
inner join updateUser using(updateUserId)
inner join product using(productId)
inner join category using(categoryId);
	