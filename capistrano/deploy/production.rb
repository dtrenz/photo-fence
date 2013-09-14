# server(s)
role :web, ''

# user/group
set :user, ''
set :group, ''

# deploy target directory
set :deploy_to, ''

namespace :deploy do

  # prompt for release tag annotation
  task :tag_release do
    set :branch do
      tag = "#{release_name}"

      annotation = Capistrano::CLI.ui.ask('Please provide an annotation for this release: ')

      if annotation.empty?
        raise CommandError.new('You must provide an annotation for the release.')
      end

      run_locally("git tag -a #{tag} -m '#{annotation}'")
      run_locally("git push origin --tags")

      tag
    end
  end

end

before 'deploy:update', 'deploy:tag_release'