###########################
# KEY-PAIR
###########################

variable "aws_ssh_key" {
  default = "ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQClFxq0O91KsqPLYWeONMjta9p5XsoP/LjzE1jUayr4n5c7uUb/ND9rab9lD+6DK0fhvN58xfZ4YdqPA1HUubaZtE21TIqL6zcOJ8c2z55iBEpzN6c9x6bmS+ZmOrWMUWsweZa1WWBz6UMDvrCRy+yDysndGOLbHZbjtYPv9Zg/9aCunVYDbQIfStRl9YwrR/wtIAyC5PsXJMoaoGrkh5Ac24upkPXCfm2MDirZuKfeMFh+5gSEzSfXXS1OKSVfXrxh9uL+TyqL1MCOn8QSxHVvdaLql6p0FXZrU53RXg5fVz0OwX2W1iSi/7xJiTcXoqZH7RhsH+gLfi1GdljQ2hCj s0dy@thinkpad"
}

resource "aws_key_pair" "terraform_ec2_key" {
  key_name = "terraform_ec2_key"
  public_key = "${var.aws_ssh_key}"
}
