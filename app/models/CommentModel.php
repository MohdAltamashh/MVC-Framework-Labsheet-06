<?php
class CommentModel{private PDO $db;function __construct(){$this->db=Database::connection();}
function all():array{return $this->db->query('SELECT * FROM comments ORDER BY id DESC')->fetchAll();}
function add(string $name,string $body):void{$s=$this->db->prepare('INSERT INTO comments(name,body) VALUES(?,?)');$s->execute([$name,$body]);}}
