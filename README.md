# Installation:

### Prerequisites:
1. Install VirtualBox (https://www.virtualbox.org)

2. Install Vagrant (https://www.vagrantup.com/downloads.html) for your particular operating system

3. Run `vagrant` on your command line to check if the installation was successful (you should see a list of Vagrant commands if the install was a success!)

### Installing Laravel Homestead:
Laravel Homestead is a Vagrant box (essentially a VM) that will run and host all of your Laravel assets. For more information and a detailed installation process, follow this link: https://laravel.com/docs/5.6/homestead#introduction

1. In your command line application of choice, retrieve the `laravel/homestead` box from the Vagrant box repository by running 
```
vagrant box add laravel/homestead
```

* If this fails, make sure your Vagrant install is up-to-date.

2. Install Laravel Homestead by cloning the repository. Feel free to change the destination directory, but note that we will be using the following for the rest of the install process: 
```
git clone https://github.com/laravel/homestead.git ~/Homestead
```

3. Check out the specific branch of Homestead (version 7.1.2, in our case):
```
cd ~/Homestead

git checkout v7.1.2
```
4. Once the Homestead repository has been cloned into `~/Homestead` (or wherever you specified in step 2), run the init script for your specific operating system:

```
// Mac / Linux...
bash init.sh

// Windows...
init.bat
```

### Configuring Laravel Homestead

Once the init script has finished initializing Homestead on your machine, we need to configure the installation to suit our needs for this particular development project. If you're interested in learning more about the configuration options, check out the docs at https://laravel.com/docs/5.6/homestead#configuring-homestead

1. First, we need to set the VM provider that Homestead will be using. Since we downloaded VirtualBox earlier in the process (or you may have already had it downloaded on your machine), we will tell Homestead to use the VirtualBox engine to spin up our Laravel development environment. In the `Homestead.yaml` file, make sure the `provider` key looks like this:

```
provider: virtualbox
```

2. Next, we need to create the directory where Homestead is going to look for our code. To make things quicker, I have created a starting repository for you. Either clone it down using git, or download the repository to your local machine here: https://github.com/AlexanderSix/cuhackit-laravel

```
// Using an SSH key
git clone git@github.com:AlexanderSix/cuhackit-laravel.git

// Using HTTPS
git clone https://github.com/AlexanderSix/cuhackit-laravel.git
```

3. Next, we need to configure the shared folders. This will allow us to write code on our own personal machines, but *RUN* the code on the Homestead VM. That way, we are all running our code on the same "machine", which makes debugging a lot simpler, and prevents the "it works on my machine" problem. Make the following adjustments in your `Homestead.yaml` file:

```
folders:
	- map: ~/directory/from/step/2/cuhackit-laravel/app
	  to: /home/vagrant/code/cuhackit-laravel
```

4. Now that we've told Homestead where to find our files, we need to tell it how to serve our files to our web browser so we can actually see our progress. Luckily for us, Homestead comes bundled with Nginx (https://www.nginx.com), so we only have to make a few changes to our `Homestead.yaml` to see our web app live in our browser:

```
sites:
	- map: cuhackit.localhost
	  to: /home/vagrant/code/cuhackit-laravel/public
```
* Note: It's important to make sure you are pointing the site to the **public** directory inside the Laravel application--that's where the entry point, `index.php` is housed.

* Note #2: If you change this `Homestead.yaml` file after you've already spun up your vagrant box (more on that in a bit), make sure to run vagrant reload --provision to apply your changes


5. If you navigate to cuhackit.localhost, you should see...nothing. That's because we haven't told our machine how to handle this URL yet! Long story short, your machine has a hosts file that gives it some instruction on how to handle special URLs that are requested by the browser. Here's what you have to do to fix this:

```
/* If you are not a superuser on your machine, you will
need to open the file as sudo in order to write to the
etc/hosts file */

/* Mac/Linux file location: */
/etc/hosts

/* Windows file location: */
C:\Windows\System32\drivers\etc\hosts

// Add the following line at the bottom of the file:
192.168.10.10 cuhackit.localhost
```

### Running Homestead
In order to run homestead, we have to spin up the Vagrant box that contains it. Vagrant offers a lot of different commands to manipulate the boxes and tweak how they run, but the commands that follow are the ones that you would use most frequently in Laravel development at this level. 

Note: Make sure you are in the `~/Homestead` directory (or wherever you cloned your install of Homestead) when you run these commands/.

To bring Homstead online:
```
vagrant up 
```

To tear down the Homestead VM:
```
vagrant destroy --force homestead-7
```

To re-provision the Homestead VM after a change to the `Homestead.yaml` file:
```
vagrant reload --provision
```

To "shell" into your Homestead box:
```
vagrant ssh
```

To "logout" of your Homestead box:
```
logout
```

### Configuring Laravel
Once we have the vagrant box up and running (using `vagrant up`), we can shell into it (`vagrant ssh`) and finish the last remaining bit of Laravel setup.

1. Navigate to the Laravel application directory. In this specific case:
```
cd /home/vagrant/code/cuhackit-laravel
```

2. Even though this should have been done on the clone, it's generally good practice to load all of the back-end dependencies when you begin development on a new machine. To load PHP dependencies, we use Composer (https://getcomposer.org). This is much the same as NPM for JavaScript in that it is a repository for all sorts of PHP packages. Run the following commands inside the cuhackit-laravel directory to install back-end dependencies:
```
composer install

composer dumpautoload
```

3. Once we've finished with the back-end dependencies, we also need to load all of the front-end dependencies. This can be done with NPM (https://www.npmjs.com), but another package manager, Yarn (https://yarnpkg.com/en/) is what we are going to be using because it is faster and, by default, guarantees that the versions will be the same across systems via lockfiles (check the docs for more information on either of these). Fun the following command inside the cuhackit-laravel directory to install front-end dependencies:
```
yarn
```

4. You're probably ready by now to get up and running with this framework! Try it out! Open up your web browser of choice and navigate to http://cuhackit.localhost!