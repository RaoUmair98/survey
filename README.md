
# Laravel Project Deployment on AWS

This guide will walk you through the steps required to deploy a Laravel project on AWS (Amazon Web Services) using services like EC2, RDS, and S3. 

## Prerequisites

- An AWS account
- Basic understanding of Laravel framework
- Basic knowledge of AWS services like EC2, RDS, S3
- Composer installed locally

## Steps to Deploy

### 1. Set up AWS Resources

- **EC2 Instance**: Launch an EC2 instance with the appropriate configuration (e.g., instance type, security group, key pair). Ensure the instance has the necessary permissions to interact with other AWS services.
- **RDS Instance**: Set up a MySQL RDS instance for your database needs. Make sure the security group allows inbound traffic from the EC2 instance.
- **S3 Bucket**: Create an S3 bucket to store static assets and media files if your Laravel application requires it.

### 2. SSH into EC2 Instance

Connect to your EC2 instance via SSH using the provided key pair:

```bash
ssh -i your-key.pem ec2-user@your-ec2-public-ip
```

### 3. Clone Laravel Project

Clone your Laravel project repository into the EC2 instance:

```bash
git clone https://github.com/your-username/your-laravel-project.git
```

### 4. Install Dependencies

Navigate to your project directory and install dependencies using Composer:

```bash
cd your-laravel-project
composer install
```

### 5. Configure Environment Variables

Update the `.env` file with appropriate database credentials and other environment-specific configurations.

### 6. Set File Permissions

Adjust file permissions for Laravel:

```bash
sudo chown -R apache:apache /var/www/html/your-laravel-project
sudo chmod -R 755 /var/www/html/your-laravel-project/storage
```

### 7. Configure Apache

Set up Apache to serve your Laravel application. Create a virtual host configuration file if necessary.

### 8. Set up Database

Migrate and seed your database if required:

```bash
php artisan migrate --seed
```

### 9. Test Application

Test your Laravel application to ensure it's working as expected:

```bash
php artisan serve
```

### 10. Configure DNS (Optional)

If you have a domain name, configure the DNS settings to point to your EC2 instance's public IP.

### 11. Monitoring and Scaling

Monitor your EC2 instance, RDS instance, and other AWS resources using AWS CloudWatch. Scale resources as needed to handle varying loads.

### 12. Continuous Deployment (Optional)

Set up a CI/CD pipeline using services like AWS CodePipeline and AWS CodeDeploy to automate deployment whenever changes are pushed to your repository.

## Additional Resources

- [AWS Documentation](https://docs.aws.amazon.com/index.html)
- [Laravel Documentation](https://laravel.com/docs)
- [AWS Deployment for Laravel](https://medium.com/@shaktisinh/deploying-laravel-project-on-aws-ec2-instance-9e11cf272d3a)

## Contributing

Contributions are welcome! Feel free to open an issue or submit a pull request.

## License

This project is licensed under the [MIT License](LICENSE).

