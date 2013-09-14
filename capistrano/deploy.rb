# ==============================================================================
# configure stages for multistage deploys
# ==============================================================================
set :stages, %w(production staging)
set :default_stage, 'staging'
require 'capistrano/ext/multistage'

# ==============================================================================
# global config for all stages
# ==============================================================================
set :application, 'MyApp'

# SCM config
set :scm, :git
set :repository, 'https://github.com/dtrenz/bootstrap'
set :branch, 'master'

# deploy strategy
set :deploy_via, :remote_cache

# for :copy deploy strategy, use scp instead of sftp
# set :copy_via, :scp

# for :copy deploy strategy, exclude these files/dirs
# set :copy_exclude, ['.DS_Store', '.git', '.gitignore', '.gitmodules', 'README.md', 'Capfile', 'config', 'assets/config.rb', 'assets/stylesheets', 'assets/sass', 'assets/.sass-cache']

# prevent compatibility errors due to extracting tars on Linux that were made on OS X
set :copy_local_tar, '/usr/bin/gnutar' if `uname` =~ /Darwin/

namespace :assets do

  # compiles assets
  task :compile do
    compass.compile
    requirejs.optimize
  end

  # uploads compiled assets
  task :upload do
    find_servers_for_task(current_task).each do |server|
      run_locally("rsync -lrptze 'ssh -q' assets/css assets/images assets/js-optimized #{user}@#{server.host}:#{current_release}/assets/")
    end
  end

  namespace :compass do

    # compiles SCSS and sprites by running compass compile.
    task :compile do
      run_locally('compass clean assets && compass compile assets --output-style compressed')
    end

  end

  namespace :requirejs do

    # optimize javascripts via requirejs optimizer
    task :optimize do
      run_locally("cd assets/tools && node r.js -o build.js")
    end

  end
end

before 'deploy:finalize_update', 'assets:compile', 'assets:upload'
