###########################
#SECURITY GROUP
###########################

resource "aws_security_group" "allow_ssh" {
  name = "terraform-example-instance"

  ingress {
    from_port = 22
    to_port = 22
    protocol = "tcp"
    cidr_blocks = ["0.0.0.0/0"]
  }
}

