# -*- mode: ruby -*-
# vi: set ft=ruby :

# All Vagrant configuration is done below. The "2" in Vagrant.configure
# configures the configuration version (we support older styles for
# backwards compatibility). Please don't change it unless you know what
# you're doing.
Vagrant.configure(2) do |config|
  # The most common configuration options are documented and commented below.
  # For a complete reference, please see the online documentation at
  # https://docs.vagrantup.com.

  # Every Vagrant development environment requires a box. You can search for
  # boxes at https://atlas.hashicorp.com/search.
  config.vm.box = "ubuntu/trusty64"

  # Create a private network, which allows host-only access to the machine
  # using a specific IP.
  config.vm.network "private_network", ip: "192.168.62.54"
  
  # Provider-specific configuration so you can fine-tune various
  # backing providers for Vagrant. These expose provider-specific options.
  # Example for VirtualBox:
  #
  config.vm.provider "virtualbox" do |vb|
     # Customize the amount of memory on the VM:
     vb.memory = "1536"

     # A fix for speed issues with DNS resolution:
     # http://serverfault.com/questions/453185/vagrant-virtualbox-dns-10-0-2-3-not-working?rq=1
     vb.customize ["modifyvm", :id, "--natdnshostresolver1", "on"]

     # Set the timesync threshold to 59 seconds, instead of the default 20 minutes.
     # 59 seconds chosen to ensure SimpleSAML never gets too far out of date.
     vb.customize ["guestproperty", "set", :id, "/VirtualBox/GuestAdd/VBoxService/--timesync-set-threshold", 59000]
  end
  #
  # View the documentation for the provider you are using for more
  # information on available options.

  # This provisioner runs on the first `vagrant up`.
  config.vm.provision "install", type: "shell", inline: <<-SHELL
    # Add Docker apt repository
    sudo apt-key adv --keyserver hkp://p80.pool.sks-keyservers.net:80 --recv-keys 58118E89F3A912897C070ADBF76221572C52609D
    sudo sh -c 'echo deb https://apt.dockerproject.org/repo ubuntu-trusty main > /etc/apt/sources.list.d/docker.list'
    sudo apt-get update -y

    # Add NTP so that the LDAP queries don't unexpectedly fail.
    sudo apt-get install ntp -y

    # Uninstall old lxc-docker
    apt-get purge lxc-docker
    apt-cache policy docker-engine

    # Install docker and dependencies
    sudo apt-get install -y linux-image-extra-$(uname -r)
    sudo apt-get install -y docker-engine

    # Add user vagrant to docker group
    sudo groupadd docker
    sudo usermod -aG docker vagrant

    # Install Docker Compose
    curl -L https://github.com/docker/compose/releases/download/1.9.0/docker-compose-`uname -s`-`uname -m` > /usr/local/bin/docker-compose
    chmod +x /usr/local/bin/docker-compose
  SHELL

  # This provisioner runs on every `vagrant reload' (as well as the first
  # `vagrant up`), reinstalling from local directories
  config.vm.provision "recompose", type: "shell", run: "always", inline: <<-SHELL

    cd /vagrant
    
    # Set necessary environment variables for shell access.
    export COMPOSER_CACHE_DIR=/tmp
    export DOCKER_UIDGID="$(id -u):$(id -g)"
    
    # Set up necessary env. vars to automatically be present each time.
    cat << 'EOF' >> /home/vagrant/.bashrc
export COMPOSER_CACHE_DIR=/tmp
export DOCKER_UIDGID="$(id -u):$(id -g)"
EOF

  SHELL

end
