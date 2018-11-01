###########################
# PROVIDER
###########################

provider "aws" {
  access_key = "${var.aws_access_key_id}"
  secret_key = "${var.aws_secret_access_key}"
  region = "${var.aws_region}"
}

###########################
# ELASTIC IP
###########################

data "aws_eip" "webserver-ip" {
  public_ip = "35.180.10.123"
}

resource "aws_eip_association" "webserver-eip" {
  instance_id   = "${aws_instance.webserver.id}"
  allocation_id = "${data.aws_eip.webserver-ip.id}"
}

###########################
# ADD SSH KEY
###########################

resource "aws_key_pair" "terraform_ec2_key" {
  key_name = "terraform_ec2_key"
  public_key = "${var.aws_ssh_key}"
}

###########################
# INSTANCE
###########################

resource "aws_instance" "webserver" {
  ami = "ami-969c2deb"
  instance_type = "t2.micro"
  key_name = "${aws_key_pair.terraform_ec2_key.id}"
  vpc_security_group_ids = [
    "${aws_security_group.allow_ssh.id}",
    "${aws_security_group.allow_http.id}"
  ]

  tags {
  Name = "hifive-webserver"
  }
}
